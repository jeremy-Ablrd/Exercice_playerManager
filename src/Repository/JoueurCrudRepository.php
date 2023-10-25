<?php

namespace App\Repository;

use App\Entity\JoueurCrud;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JoueurCrud>
 *
 * @method JoueurCrud|null find($id, $lockMode = null, $lockVersion = null)
 * @method JoueurCrud|null findOneBy(array $criteria, array $orderBy = null)
 * @method JoueurCrud[]    findAll()
 * @method JoueurCrud[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JoueurCrudRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JoueurCrud::class);
    }

//    /**
//     * @return JoueurCrud[] Returns an array of JoueurCrud objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?JoueurCrud
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
