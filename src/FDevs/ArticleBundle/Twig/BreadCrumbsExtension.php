<?php

namespace FDevs\ArticleBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

class BreadCrumbsExtension extends \Twig_Extension
{
    protected $container;
    protected $breadcrumbs;
    protected $template;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->breadcrumbs = $container->get('bread_crumbs');

    }

    public function getFunctions()
    {
        return array(
            'show_breadcrumbs' => new \Twig_Function_Method($this, 'getTmp', array('is_safe' => array("html"))),
        );
    }

    public function getBreadcrumbs()
    {
        return $this->container->get('bread_crumbs')->getBreadCrumbs();
    }

    public function getTmp()
    {
        $template = $this->container->get('templating')->render('FDevsArticleBundle:Breadcrumbs:breadcrumbs.html.twig', array('breadcrumbs' => $this->getBreadcrumbs()));
        return $template;
    }

    public function getName()
    {
        return 'bread_crumbs_extension';
    }
}