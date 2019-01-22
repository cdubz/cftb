<?php

namespace App\Repository;

use App\Entity\ApiUpdateLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ApiUpdateLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApiUpdateLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApiUpdateLog[]    findAll()
 * @method ApiUpdateLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApiUpdateLogRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ApiUpdateLog::class);
    }

    public function findOneByMostRecentUpdate($endpoint): ?ApiUpdateLog
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.endpoint = :val')
            ->setParameter('val', $endpoint)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
