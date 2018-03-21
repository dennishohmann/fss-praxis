<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\ORM\EntityRepository;

class ArticleRepository extends EntityRepository
{
    /**
     * @return Article[]
     */
    public function findAll()
    {
        return $this->createQueryBuilder('article')
            ->orderBy('article.name', 'DESC')
            ->getQuery()
            ->execute();
    }
}
