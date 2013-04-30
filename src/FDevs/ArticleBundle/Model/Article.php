<?php
/**
 * @author Andrey Samusev <Andrey.Samusev@exigenservices.com>
 * @copyright andrey 4/30/13
 * @version 1.0.0
 */

namespace FDevs\ArticleBundle\Model;


abstract class Article {

    protected $id;
    protected $title;
    protected $type;
    protected $status;
    protected $tags;
    protected $category;
    protected $createdAt;
    protected $publishedAt;
    protected $content;
    protected $author;
    protected $rating;

}