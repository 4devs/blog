<?php

namespace FDevs\ArticleBundle\Controller;

use FDevs\ArticleBundle\Model\ArticleSearch;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    public function indexAction()
    {
        return $this->render('FDevsArticleBundle:Search:index.html.twig', array(
            'form' => $this->createSearchForm()->createView(),
        ));
    }

    public function findArticlesAction(Request $request, $page = null)
    {
        $form = $this->createSearchForm(new ArticleSearch());
        $form->handleRequest($request);

        $pagination = null;
        if ($form->isValid()) {
            /** @var ArticleSearch $articleSearch */
            $articleSearch = $form->getData();
            $searchQuery = $this
                ->get('fos_elastica.manager')
                ->getRepository('FDevsArticleBundle:Article')
                ->getQueryForSearch($articleSearch)
            ;
            $finder = $this->get('fos_elastica.finder.blog.article');
            $pagination = $this->get('knp_paginator')->paginate(
                $finder->createPaginatorAdapter($searchQuery),
                $page,
                $articleSearch->getPerPage()
            );
        }

        return $this->render('FDevsArticleBundle:Search:findArticles.html.twig', array(
            'pagination' => $pagination,
            'form' => $form->createView(),
        ));
    }

    /**
     * @param ArticleSearch $articleSearch
     *
     * @return FormInterface
     */
    protected function createSearchForm(ArticleSearch $articleSearch = null)
    {
        return $this->get('form.factory')->createNamed('', 'fdevs_article_search', $articleSearch);
    }
}
