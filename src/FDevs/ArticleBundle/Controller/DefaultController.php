<?php
namespace FDevs\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    public function indexAction($page = 0)
    {
        $qb = $this->container->get('doctrine_mongodb')
            ->getManager()
            ->createQueryBuilder('FDevsArticleBundle:Article');
        $articles = $qb
            ->field('publish')->equals(true)
            ->skip($page)
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
        if (!$article) {
            throw new NotFoundHttpException('article Not Found');
        }
        return $this->render('FDevsArticleBundle:Default:article.html.twig', array('article' => $article));
    }

    public function tagAction($tag, $page = 0)
    {
        $articles = $this->container->get('doctrine_mongodb')
            ->getManager()
            ->createQueryBuilder('FDevsArticleBundle:Article')
            ->field('publish')->equals(true)
            ->field('tags.id')->equals($tag)
            ->skip($page)
            ->limit(20)
            ->sort('createdAt', 'desc')
            ->getQuery()
            ->execute();

        if (!$articles->count()) {
            throw new NotFoundHttpException('articles Not Found');
        }

        return $this->render('FDevsArticleBundle:Default:index.html.twig', array('articles' => $articles));
    }

    public function categoryAction($category, $page = 0)
    {
        $articles = $this->container->get('doctrine_mongodb')
            ->getManager()
            ->createQueryBuilder('FDevsArticleBundle:Article')
            ->field('publish')->equals(true)
            ->field('categories.id')->equals($category)
            ->skip($page)
            ->limit(20)
            ->sort('createdAt', 'desc')
            ->getQuery()
            ->execute();

        if (!$articles->count()) {
            throw new NotFoundHttpException('articles Not Found');
        }

        return $this->render('FDevsArticleBundle:Default:index.html.twig', array('articles' => $articles));
    }
}
