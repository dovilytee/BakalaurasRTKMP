<?php

namespace App\Repository;

use App\Entity\TripNumber;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TripNumber>
 *
 * @method TripNumber|null find($id, $lockMode = null, $lockVersion = null)
 * @method TripNumber|null findOneBy(array $criteria, array $orderBy = null)
 * @method TripNumber[]    findAll()
 * @method TripNumber[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TripNumberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TripNumber::class);
    }

//    /**
//     * @return TripNumber[] Returns an array of TripNumber objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TripNumber
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
