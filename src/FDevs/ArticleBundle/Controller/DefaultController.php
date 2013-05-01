<?php

namespace FDevs\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $qb = $this->container->get('doctrine_mongodb')
            ->getManager()
            ->createQueryBuilder('FDevsArticleBundle:Article');
        $articles = $qb
            ->field('publish')->equals(true)
            ->limit(20)
            ->sort('createdAt', 'desc')
            ->getQuery()
            ->execute();
        return $this->render('FDevsArticleBundle:Default:index.html.twig', array('articles' => $articles));
    }

    public function articleAction($slug)
    {
        $dm = $this->container->get('doctrine_mongodb')->getManager();
        $article = $dm->find('FDevsArticleBundle:Article', $slug);
        if(!$article)
        {
            throw new NotFoundHttpException('article Not Found');
        }
        return $this->render('FDevsArticleBundle:Default:article.html.twig', array('article' => $article));
    }
}
