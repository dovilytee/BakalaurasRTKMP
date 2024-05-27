<?php

namespace App\Repository;

use App\Entity\Trip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Trip>
 *
 * @method Trip|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trip|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trip[]    findAll()
 * @method Trip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TripRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trip::class);
    }
    public function add(Trip $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Trip $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    /**
     * get all posts
     *
     * @return array
     */
    public function findAllPlace()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a
         FROM App:Trip a
      
         ORDER BY a.posted_at DESC'
            )
            ->getArrayResult();
    }

    /**
     * get one by id
     *
     * @param integer $id
     *
     * @return array
     */
    public function findOneById($id)
    {
        return $this->getEntityManager()
            ->createQuery(
                "SELECT a, u.username
       FROM App:Annonce
       a JOIN a.user u
        WHERE a.id = id"
            )
            ->setParameter('id', $id)
            ->getArrayResult();
    }


    /**
     * get one by id
     *
     * @param integer $id
     *
     * @return object or null
     */
    public function findTripByid($id)
    {
        try {
            return $this->getEntityManager()
                ->createQuery(
                    "SELECT p
                FROM App\Entity\Trip
                p WHERE p.id =:id"
                )
                ->setParameter('id', $id)
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }
    public function findEntitiesByString($str){
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p
                FROM App:Trip p
                WHERE p.name LIKE :str'
            )
            ->setParameter('str', '%'.$str.'%')
            ->getResult();
    }
    public function findByTripCity(int $tripCityId): array{
        return $this->createQueryBuilder('t')
            ->join('t.tripCity', 'tc')
            ->andWhere('tc.id = :tripCityId')
            ->setParameter('tripCityId', $tripCityId)
            ->getQuery()
            ->getResult();
    }
    public function findByTripNumber(int $tripNumberId): array{
        return $this->createQueryBuilder('t')
            ->join('t.tripNumber', 'tn')
            ->andWhere('tn.id = :tripNumberId')
            ->setParameter('tripNumberId', $tripNumberId)
            ->getQuery()
            ->getResult();
    }
//    /**
//     * @return Route[] Returns an array of Route objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Route
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
