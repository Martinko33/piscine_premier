<?php

namespace App\Repository;

use App\Entity\IsPublished;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IsPublished|null find($id, $lockMode = null, $lockVersion = null)
 * @method IsPublished|null findOneBy(array $criteria, array $orderBy = null)
 * @method IsPublished[]    findAll()
 * @method IsPublished[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IsPublishedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IsPublished::class);
    }

    // /**
    //  * @return IsPublished[] Returns an array of IsPublished objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IsPublished
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
