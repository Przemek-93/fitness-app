<?php

namespace App\Service\CRUD;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Serializer\SerializerAdapterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserCrud extends AbstractDoctrineCrud
{
    protected string $entityName = User::class;
    protected UserPasswordEncoderInterface $encoder;

    public function __construct(
        EntityManagerInterface $entityManager,
        SerializerAdapterInterface $serializer,
        ValidatorInterface $validator,
        UserPasswordEncoderInterface $encoder
    ) {
        $this->encoder = $encoder;
        parent::__construct($entityManager, $serializer, $validator);
    }

    public function create(string $post, array $groups = ['json']): string
    {
        $entity = $this->serializer->deserialize($post, $this->entityName, $groups);
        $errors = $this->validator->validate($entity, null);
        $this->convertErrors($errors);
        $entity->setPassword($this->encoder->encodePassword($entity, $entity->getPassword()));
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $this->serializer->serialize(
            $entity,
            $groups
        );
    }
}