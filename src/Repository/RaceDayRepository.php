<?php

namespace App\Repository;

use App\Entity\RaceDay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RaceDay|null find($id, $lockMode = null, $lockVersion = null)
 * @method RaceDay|null findOneBy(array $criteria, array $orderBy = null)
 * @method RaceDay[]    findAll()
 * @method RaceDay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RaceDayRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RaceDay::class);
    }

    // /**
    //  * @return RaceDay[] Returns an array of RaceDay objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RaceDay
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
