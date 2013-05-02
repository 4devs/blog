<?php
/**
 * @author Andrey Samusev <Andrey.Samusev@exigenservices.com>
 * @copyright andrey 4/30/13
 * @version 1.0.0
 */

namespace FDevs\ArticleBundle\Model;


class Tag
{
    /**
     * @var string
     */
    protected $id;
    /**
     * @var string
     */
    protected $title;
    /**
     * @var int
     */
    protected $count;
    /**
     * @var \DateTime
     */
    protected $createdAt;

    function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param int $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function __toString()
    {
        return $this->title ? : "";
    }

}