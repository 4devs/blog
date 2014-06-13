<?php

namespace FDevs\ArticleBundle\Document;

use Doctrine\ODM\MongoDB\DocumentRepository;
use FDevs\UserBundle\Document\User;

class ArticleRepository extends DocumentRepository
{
    /**
     * @var string
     */
    private $authorId = '';

    /**
     * @var int
     */
    private $limit = 10;

    /**
     * @var int
     */
    private $offset = 0;

    /**
     * set User Id
     *
     * @param string $userId
     * @return $this
     */
    public function setUserId($userId)
    {
        $this->authorId = $userId;

        return $this;
    }

    /**
     * get Query By Category
     *
     * @param  string $categoryId
     * @return \Doctrine\MongoDB\Query\Query
     */
    public function getQueryByCategory($categoryId)
    {
        return $this->getQueryBuilder()->field('categories.id')->equals($categoryId)->getQuery();
    }

    /**
     * get Query By Tag
     *
     * @param  string $tagId
     * @return \Doctrine\MongoDB\Query\Query
     */
    public function getQueryByTag($tagId)
    {
        return $this->getQueryBuilder()->field('tags.id')->equals($tagId)->getQuery();
    }

    /**
     * get Query
     *
     * @return \Doctrine\MongoDB\Query\Query
     */
    public function getQuery()
    {
        return $this->getQueryBuilder()->getQuery();
    }

    /**
     * set Limit
     *
     * @param int $limit
     * @return $this
     */
    public function setLimit($limit = 10)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * get Query Builder
     *
     * @param  bool $publish
     * @return \Doctrine\MongoDB\Query\Builder
     */
    private function getQueryBuilder($publish = true)
    {
        $qb = $this->createQueryBuilder()
            ->field('publish')->equals($publish)
            ->limit($this->limit)
            ->sort('publishedAt', 'desc');

        if ($this->offset) {
            $qb->skip($this->offset);
        }
        if ($this->authorId) {
            $qb->field('authors')->exists(true)->field('authors.id')->equals($this->authorId);
        }

        return $qb;
    }

    /**
     * set Offset
     *
     * @param int $page
     *
     * @return $this
     */
    public function setPage($page = 1)
    {
        $this->offset = abs($page - 1) * $this->limit;

        return $this;
    }

    public function getArticle($slug){
        return $this->getQueryBuilder()
            ->field('_id')->equals($slug)
            ->getQuery();
    }

    public function getLastModified($query = null)
    {
        $query = $query ? : $this->getQueryBuilder()->getQuery();
        $article = $query->getSingleResult();

        return $article ? $article->getPublishedAt() : new \DateTime();
    }
}
