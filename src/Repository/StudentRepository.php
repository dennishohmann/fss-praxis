<?php

namespace App\Repository;

use App\Entity\Student;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }

    /**
     * Nur Students des aktuellen User
     * @return Student[]
     */
    public function findByTeacher(User $user)
    {//$qb->innerJoin('u.Group', 'g', 'WITH', 'u.status = ?1', 'g.id')
        return $this->createQueryBuilder('student')
            ->leftJoin('student.teachers', 'st')
            ->andWhere('st = :teacher')
            ->setParameter('teacher', $user)
            ->orderBy('student.name')
            ->getQuery()
            ->execute();
    }
}
