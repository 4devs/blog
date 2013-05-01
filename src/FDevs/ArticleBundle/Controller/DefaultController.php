<?php

namespace FDevs\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $dm = $this->container->get('doctrine_mongodb')->getManager();
        $dm->getRepository('FDevsArticleBundle:Article');
        $dm->find('FDevsArticleBundle:Article', $slug);
        return $this->render('FDevsArticleBundle:Default:index.html.twig', array('name' => 'Andrey'));
    }

    public function articleAction($slug)
    {
        $dm = $this->container->get('doctrine_mongodb')->getManager();
        $article = $dm->find('FDevsArticleBundle:Article', $slug);
        return array('article' => $article);
    }
}
