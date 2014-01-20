<?php

namespace FDevs\ArticleBundle\Menu;

use FDevs\ArticleBundle\Model\Article;
use FDevs\ArticleBundle\Model\Category;
use Knp\Menu\FactoryInterface;
use Knp\Menu\MenuItem;
use Symfony\Component\DependencyInjection\ContainerAware;

class BreadCrumbs extends ContainerAware
{
    /**
     * @var string
     */
    private $userName;

    /**
     * @param  FactoryInterface        $factory
     * @param  array                   $options
     * @return \Knp\Menu\ItemInterface
     */
    public function base(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('breadcrumbs')
            ->setChildrenAttribute('class', 'breadcrumb')
            ->setExtra('translation_domain', 'FDevsArticleBundle');

        $this->userName = $this->container->get('request')->get('username');

        if (isset($options['category']) && $options['category'] instanceof Category) {
            $this->setCategory($menu, $options['category']);
        }

        if (isset($options['article']) && $options['article'] instanceof Article) {

            $this->setCategory($menu, $options['article']->getParentCategory());

            $menu->addChild(
                $options['article']->getTitle(),
                array(
                    'route' => 'f_devs_article_article',
                    'routeParameters' => array('slug' => $options['article']->getId(), 'username' => $this->userName)
                )
            );

        }

        if ($menu->count()) {
            $menu
                ->addChild(
                    'menu.home',
                    array('route' => 'f_devs_article_homepage', 'routeParameters' => array('username' => $this->userName))
                )
                ->moveToFirstPosition();

            $menu->getLastChild()->setCurrent(true);
        }

        return $menu;
    }

    /**
     * set Category
     *
     * @param MenuItem $menu
     * @param Category $category
     * @return $this
     */
    private function setCategory(MenuItem $menu, Category $category)
    {
        do {
            $menu
                ->addChild(
                    $category->getTitle(),
                    array(
                        'route' => 'f_devs_article_category',
                        'routeParameters' => array('category' => $category->getId(), 'username' => $this->userName)
                    )
                )
                ->moveToFirstPosition();
        } while ($category = $category->getParent());

        return $this;
    }
}
