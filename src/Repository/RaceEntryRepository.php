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
}
