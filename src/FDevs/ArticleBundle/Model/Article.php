<?php
/**
 * @author Andrey Samusev <Andrey.Samusev@exigenservices.com>
 * @copyright andrey 4/30/13
 * @version 1.0.0
 */

namespace FDevs\ArticleBundle\Model;

use FDevs\UserBundle\Document\User;

class Article
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
     * @var string $type
     */
    protected $type;

    /**
     * @var boolean $publish
     */
    protected $publish;

    /**
     * @var string $description
     */
    protected $description;

    /**
     * @var string $content
     */
    protected $content;

    /**
     * @var array $authors
     */
    protected $authors;

    /**
     * @var int $rating
     */
    protected $rating;

    /**
     * @var \DateTime $createdAt
     */
    protected $createdAt;

    /**
     * @var \DateTime $publishedAt
     */
    protected $publishedAt;

    /**
     * @var string
     */
    protected $locale;

    /**
     * @var Category
     */
    protected $categories = array();

    /**
     * @var Tag
     */
    protected $tags = array();

    public function __construct()
    {
        $this->type = "draft";
        $this->rating = 0;
        $this->createdAt = new \DateTime();
        $this->publishedAt = new \DateTime();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->authors = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set id
     *
     * @param  string  $id
     * @return Article
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
     * @param  string  $title
     * @return Article
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
     * Set type
     *
     * @param  string  $type
     * @return Article
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set publish
     *
     * @param  boolean $publish
     * @return Article
     */
    public function setPublish($publish)
    {
        $this->publish = $publish;

        return $this;
    }

    /**
     * Get publish
     *
     * @return boolean $publish
     */
    public function getPublish()
    {
        return $this->publish;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set content
     *
     * @param  string  $content
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string $content
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Add Author
     *
     * @param User $user
     */
    public function addAuthor(User $user)
    {
        $this->authors[] = $user;
    }

    /**
     * Remove Author
     *
     * @param User $user
     */
    public function removeAuthor(User $user)
    {
        $this->authors->removeElement($user);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection $authors
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Set rating
     *
     * @param  int     $rating
     * @return Article
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return int $rating
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set createdAt
     *
     * @param  \DateTime $createdAt
     * @return Article
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
     * Set publishedAt
     *
     * @param  \DateTime $publishedAt
     * @return Article
     */
    public function setPublishedAt(\DateTime $publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime $publishedAt
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Add categories
     *
     * @param Category $categories
     */
    public function addCategorie(Category $categories)
    {
        $this->categories[] = $categories;
    }

    /**
     * Remove categories
     *
     * @param Category $categories
     */
    public function removeCategorie(Category $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection $categories
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @return Category
     */
    public function getParentCategory()
    {
        return $this->categories->first();
    }

    /**
     * Add tags
     *
     * @param Tag $tags
     */
    public function addTag(Tag $tags)
    {
        $this->tags[] = $tags;
    }

    /**
     * Remove tags
     *
     * @param Tag $tags
     */
    public function removeTag(Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection $tags
     */
    public function getTags()
    {
        return $this->tags;
    }

    public function __toString()
    {
        return $this->title ? : "New";
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param string $locale
     * 
     * @return self
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        
        return $this;
    }

    public function addDescription()
    {
        $this->description = '';
        $pageBreak = array(
            '<div class="moreEdit" id="fdevscut">&nbsp;</div>',
            '<div class="moreEdit" contenteditable="false" id="fdevscut"><span style="display:none">&nbsp;</span></div>',
        );
        foreach ($pageBreak as $break) {
            $this->description = $this->description ? : trim(strstr($this->content, $break, true));
        }
    }

}
