<?php

namespace App\Repository;

use App\Entity\Klasse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Klasse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Klasse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Klasse[]    findAll()
 * @method Klasse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KlasseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Klasse::class);
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

    /**
     * @return Klasse[]
     */
    public function findAll()
    {
        return $this->createQueryBuilder('klasse')
            ->orderBy('klasse.name', 'DESC')
            ->getQuery()
            ->execute();
    }
}
