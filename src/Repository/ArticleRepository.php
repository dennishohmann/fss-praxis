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

    public function findAllAuthorName()
    {
        return $this->createQueryBuilder('article')
            ->select('article.id', 'article.title', 'article.slug', 'article.publishDate', 'user.lastname', 'user.firstname')
            ->leftJoin('article.user', 'user')
            ->orderBy('article.publishDate', 'DESC')
            ->getQuery()
            ->execute();
    }

    public function findOneWithAuthor($id)
    {
        return $this->createQueryBuilder('article')
            ->select('article.id', 'article.title', 'article.content', 'article.slug', 'user.firstname', 'user.lastname')
            ->leftJoin('article.user', 'user')
            ->andWhere('article.id = :article')
            ->setParameter('article', $id)
            ->getQuery()
            ->execute();
    }

}
