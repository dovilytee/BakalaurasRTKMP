<?php

namespace App\Repository;

use App\Entity\PlaceCity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlaceCity>
 *
 * @method PlaceCity|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlaceCity|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlaceCity[]    findAll()
 * @method PlaceCity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlaceCityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlaceCity::class);
    }

//    /**
//     * @return PlaceCity[] Returns an array of PlaceCity objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PlaceCity
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
