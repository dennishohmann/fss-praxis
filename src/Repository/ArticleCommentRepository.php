<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\ArticleComment;
use Doctrine\ORM\EntityRepository;

class ArticleCommentRepository extends EntityRepository
{
    /**
     * @param Article $article
     * @return ArticleComment[]
     */
    public function findAllRecentNotesForArticle(Article $article)
    {
        return $this->createQueryBuilder('article_comment')
            ->andWhere('article_comment.comment = :article')
            ->setParameter('article', $article)
            ->andWhere('article_comment.createdAt > :recentDate')
            ->setParameter('recentDate', new \DateTime('-3 months'))
            ->orderBy('article_comment.createdAt', 'DESC')
            ->getQuery()
            ->execute();
    }
}
