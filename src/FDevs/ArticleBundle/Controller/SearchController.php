<?php

namespace FDevs\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FDevs\ArticleBundle\Form\ArticleSearch;

class SearchController extends Controller
{

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
        $form->bindRequest($this->get('request'));

        $articles = null;
        if ($form->isValid()) {
            // TODO: add search
        }

        return $this->render('FDevsArticleBundle:Search:findArticles.html.twig', array('articles' => $articles));
    }

}