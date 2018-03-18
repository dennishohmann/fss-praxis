<?php

namespace App\Repository;

use App\Entity\Sus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Sus|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sus|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sus[]    findAll()
 * @method Sus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SusRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Sus::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('s')
            ->where('s.something = :value')->setParameter('value', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
