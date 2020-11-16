<?php

namespace App\Repository;

use App\Entity\TrainingActivity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TrainingActivity|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrainingActivity|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrainingActivity[]    findAll()
 * @method TrainingActivity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrainingActivityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TrainingActivity::class);
    }

    // /**
    //  * @return TrainingActivity[] Returns an array of TrainingActivity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
