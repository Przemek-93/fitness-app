<?php

namespace App\Service\CRUD;

use App\Entity\TrainingActivity;
use App\Entity\User;
use App\Repository\TrainingActivityRepository;
use App\Serializer\SerializerAdapterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TrainingActivityCrud extends AbstractDoctrineCrud
{
    protected string $entityName = TrainingActivity::class;
    protected TrainingActivityRepository $activityRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        SerializerAdapterInterface $serializer,
        ValidatorInterface $validator,
        TrainingActivityRepository $activityRepository
    ) {
        parent::__construct($entityManager, $serializer, $validator);
        $this->activityRepository = $activityRepository;
    }

    public function createActivity(
        User $user,
        string $post,
        array $groups = ['json']
    ): string {
        $entity = $this->serializer->deserialize($post, $this->entityName, $groups);
        $entity->setUser($user);
        $errors = $this->validator->validate($entity, null);
        $this->convertErrors($errors);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $this->serializer->serialize(
            $entity,
            $groups
        );
    }

    public function readAllByUser(User $user, array $groups = ['json']): string
    {
        return $this->serializer->serialize(
            $this->activityRepository->findBy(['user' => $user]),
            $groups
        );
    }
}