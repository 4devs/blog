<?php
/**
 * @author Andrey Samusev <Andrey.Samusev@exigenservices.com>
 * @copyright andrey 4/30/13
 * @version 1.0.0
 */

namespace FDevs\ArticleBundle\Model;


class Category
{

    /**
     * @var $id
     */
    protected $id;

    /**
     * @var string $title
     */
    protected $title;

    /**
     * @var int $count
     */
    protected $count;

    /**
     * @var \DateTime $createdAt
     */
    protected $createdAt;

    /**
     * @var Category
     */
    protected $parent;


    /**
     * Set id
     *
     * @param string $id
     * @return Category
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Category
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set count
     *
     * @param int $count
     * @return Category
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return int $count
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Category
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime $createdAt
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set parent
     *
     * @param Category $parent
     * @return Category
     */
    public function setParent(Category $parent = null)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get parent
     *
     * @return Category $parent
     */
    public function getParent()
    {
        return $this->parent;
    }

    public function __toString()
    {
        return $this->title?:'';
    }


}