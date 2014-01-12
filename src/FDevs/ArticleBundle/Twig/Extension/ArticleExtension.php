<?php

namespace FDevs\ArticleBundle\Twig\Extension;

use FDevs\ArticleBundle\Model\Article;
use FDevs\ArticleBundle\Templating\Helper\ArticleHelper;

class ArticleExtension extends \Twig_Extension
{
    /**
     * @var ArticleHelper
     */
    protected $helper;

    /**
     * Constructor.
     *
     * @param ArticleHelper $helper
     */
    public function __construct(ArticleHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            'f_devs_article_render' => new \Twig_Function_Method($this, 'render', array('is_safe' => array('html'))),
        );
    }

    /**
     * render article
     *
     * @param  Article $article
     * @param  array   $parameters
     * @param  string  $type
     * @return string
     */
    public function render(Article $article, $parameters = array(), $type = ArticleHelper::FULL)
    {
        return $this->helper->render($article, $parameters, $type);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'f_devs_article';
    }
}
