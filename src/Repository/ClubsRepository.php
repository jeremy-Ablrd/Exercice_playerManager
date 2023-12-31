<?php

namespace App\Repository;

use App\Entity\Clubs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Clubs>
 *
 * @method Clubs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Clubs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Clubs[]    findAll()
 * @method Clubs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClubsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Clubs::class);
    }

//    /**
//     * @return Clubs[] Returns an array of Clubs objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Clubs
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
