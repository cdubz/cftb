<?php

namespace App\Repository;

use App\Entity\RaceEntry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RaceEntry|null find($id, $lockMode = null, $lockVersion = null)
 * @method RaceEntry|null findOneBy(array $criteria, array $orderBy = null)
 * @method RaceEntry[]    findAll()
 * @method RaceEntry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RaceEntryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RaceEntry::class);
    }

    // /**
    //  * @return RaceEntry[] Returns an array of RaceEntry objects
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
    public function findOneBySomeField($value): ?RaceEntry
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
