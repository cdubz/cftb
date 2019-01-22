<?php

namespace App\Repository;

use App\Entity\RaceDay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RaceDay|null find($id, $lockMode = null, $lockVersion = null)
 * @method RaceDay|null findOneBy(array $criteria, array $orderBy = null)
 * @method RaceDay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RaceDayRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RaceDay::class);
    }

    public function findAll()
    {
        return $this->findBy([], ['date' => 'DESC']);
    }

    /**
     * @return RaceDay|null Returns RaceDay object for the specified date.
     */
    public function findByDate(\DateTime $dateTime): ?RaceDay
    {
        return $this->createQueryBuilder('rd')
            ->andWhere('rd.date = :date')
            ->setParameter('date', $dateTime->format('Y-m-d'))
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
     * @return RaceDay|null Returns the most recent RaceDay object.
     */
    public function findMostRecent(): ?RaceDay
    {
        return $this->createQueryBuilder('rd')
            ->orderBy('rd.date', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
