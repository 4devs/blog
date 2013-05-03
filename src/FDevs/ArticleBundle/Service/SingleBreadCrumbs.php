<?php

namespace FDevs\ArticleBundle\Service;

class SingleBreadCrumbs
{
    public $url;
    public $text;

    public function __construct($text = "", $url = "")
    {
        $this->url = $url;
        $this->text = $text;
    }
}