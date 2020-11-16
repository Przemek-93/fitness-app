<?php

namespace App\Service\CRUD;

use App\Exception\ApiException;
use App\Serializer\SerializerAdapterInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractDoctrineCrud
{
    protected EntityManagerInterface $entityManager;
    protected SerializerAdapterInterface $serializer;
    protected ValidatorInterface $validator;
    protected ServiceEntityRepository $repository;
    protected string $entityName;

    public function __construct(
        EntityManagerInterface $entityManager,
        SerializerAdapterInterface $serializer,
        ValidatorInterface $validator
    ) {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
        $this->validator = $validator;
        if (empty($this->entityName)) {
            throw new \LogicException('Variable $entityName has to be specified');
        }
        $this->repository = $entityManager->getRepository($this->entityName);
        if (!$this->repository instanceof ServiceEntityRepository) {
            throw new \LogicException('Repository for class '.$this->entityName.' has not been found.');
        }
    }

    public function read(int $entityId, array $groups = ['json']): string
    {
        return $this->serializer->serialize(
            $this->findOneOrReturnNotFound($entityId),
            $groups
        );
    }

    public function readAll(array $groups = ['json']): string
    {
        return $this->serializer->serialize(
            $this->repository->findAll(),
            $groups
        );
    }

    public function create(string $post, array $groups = ['json']): string
    {
        $entity = $this->serializer->deserialize($post, $this->entityName, $groups);
        $errors = $this->validator->validate($entity, null);
        $this->convertErrors($errors);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $this->serializer->serialize(
            $entity,
            $groups
        );
    }

    public function update(string $post, array $groups = ['json']): string
    {
        $entity = $this->serializer->deserialize($post, $this->entityName, $groups);
        $errors = $this->validator->validate($entity, null);
        $this->convertErrors($errors);
        $this->entityManager->merge($entity);
        $this->entityManager->flush();

        return $this->serializer->serialize(
            $entity,
            $groups
        );
    }

    public function delete(int $entityId): void
    {
        $entity = $this->findOneOrReturnNotFound($entityId);
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    public function findOneOrReturnNotFound(int $entityId)
    {
        $entity = $this->repository->find($entityId);
        if ($entity === null || get_class($entity) !== $this->entityName) {
            throw new ApiException('Object with id '.$entityId.' has not been found.', 404);
        }
        return $entity;
    }

    public function findOneByOrReturnNotFound($criteria)
    {
        $entity = $this->repository->findOneBy($criteria);
        if ($entity === null || get_class($entity) !== $this->entityName) {
            throw new ApiException('Object has not been found.', 404);
        }
        return $entity;
    }

    protected function convertErrors($errors): void
    {
        if (count($errors)) {
            $exceptionContext = [];
            foreach ($errors as $error) {
                $exceptionContext[] = sprintf(
                    'Attribute: [%s]. Error: %s',
                    $error->getPropertyPath(),
                    $error->getMessage()
                );
            }
            // 400 Bad request
            throw new ApiException('Validation failed', 400, $exceptionContext);
        }
    }
}