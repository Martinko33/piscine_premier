<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }


    // je cree ma function quelle est different de find et je la associe avec $search
    public function searchByTerm($search)
    {
        //je cree mon querybuilder pour cree ma roquete
        $qb = $this->createQueryBuilder('a');
        // je cree ma roquete select ( presque pareil comme sql), select 'a' veut dire article alias a
        $query = $qb-> select('a')
            ->where('a.content LIKE :search')
            ->orWhere('a.title LIKE :search')
            // setparameter c'est la securite pour input recherche ( fait jamais confiance a utilisateur)
            // dans la where je mette :search que j'appelle a set parameter 'search' qui contient enfin ma variable $search, du coup avec ca je le mettre pas direct dans ma roquete
            ->setParameter('search', '%'.$search.'%')
            // getQuery me rasamble tout la roquete
            ->getQuery();


        return $query->getResult();

    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
