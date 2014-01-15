<?php

namespace FDevs\ArticleBundle\Templating\Helper;

use FDevs\ArticleBundle\Model\Article;
use Symfony\Component\Templating\Helper\Helper;

class ArticleHelper extends Helper
{
    const SHORT = 'description';
    const FULL = 'content';

    /**
     * render Article
     *
     * @param  Article $article
     * @param  array   $parameters
     * @param  string  $type
     * @return string
     */
    public function render(Article $article, array $parameters = array(), $type = self::FULL)
    {
        return $type == self::SHORT && $article->getDescription() ? $article->getDescription() : $article->getContent();
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'f_devs_article';
    }
}
