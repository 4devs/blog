<?php

namespace FDevs\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FDevs\ArticleBundle\Form\ArticleSearch;

class SearchController extends Controller
{

    protected $limit = 10;

    public function indexAction()
    {
        $form = $this->createForm(new ArticleSearch());

        return $this->render('FDevsArticleBundle:Search:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function findArticlesAction()
    {
        $form = $this->createForm(new ArticleSearch());
        $form->bind($this->get('request'));

        $articles = null;
        if ($form->isValid()) {

            $qb = $this->container->get('doctrine_mongodb')
                ->getManager()
                ->createQueryBuilder('FDevsArticleBundle:Article');

            $regex = new \MongoRegex('/.*' . $form->getData()['search_phrase'] . '.*/i');

            $articles = $qb
                ->field('publish')->equals(true)
                ->addOr($qb->expr()->field('content')->equals($regex))
                ->addOr($qb->expr()->field('title')->equals($regex))
                ->limit($this->limit)
                ->sort('createdAt', 'desc')
                ->getQuery()
                ->execute();
        }

        return $this->render('FDevsArticleBundle:Search:findArticles.html.twig', array(
            'articles' => $articles,
            'form' => $form->createView(),
        ));
    }

}