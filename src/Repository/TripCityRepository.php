<?php

namespace App\Repository;

use App\Entity\TripCity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TripCity>
 *
 * @method TripCity|null find($id, $lockMode = null, $lockVersion = null)
 * @method TripCity|null findOneBy(array $criteria, array $orderBy = null)
 * @method TripCity[]    findAll()
 * @method TripCity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TripCityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TripCity::class);
    }

//    /**
//     * @return TripCity[] Returns an array of TripCity objects
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

//    public function findOneBySomeField($value): ?TripCity
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
