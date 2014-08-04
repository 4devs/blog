<?php
namespace FDevs\ArticleBundle\Controller;

use Doctrine\MongoDB\Query\Query;
use FDevs\UserBundle\Document\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    public function indexAction(Request $request, $page = 1)
    {
        $query = $this->getRepository($request)->setPage($page)->getQuery();
        $this->setLastModified($request, $query);
        $pagination = $this->get('knp_paginator')->paginate($this->getRepository($request)->getQuery(), $page);

        return $this->render('FDevsArticleBundle:Default:index.html.twig', array('pagination' => $pagination));
    }

    public function getUniqueCategoriesTagsAction(Request $request)
    {
        $tags = $this->getRepository($request)->getQuery()->execute();

        $uniqueCategoriesCheck = array();
        $uniqueTagsCheck = array();
        $uniqueCategories = array();
        $uniqueTags = array();
        $i = 0;
        $r = 0;
        foreach ($tags as $val) {
            foreach ($val->getCategories() as $category) {
                if (!in_array($category->getTitle(), $uniqueCategoriesCheck)) {
                    $i++;
                    $uniqueCategoriesCheck[] = $category->getTitle();
                    $uniqueCategories[$i]['title'] = $category->getTitle();
                    $uniqueCategories[$i]['id'] = $category->getId();
                }
            }

            foreach ($val->getTags() as $tag) {
                if (!in_array($tag->getTitle(), $uniqueTagsCheck)) {
                    $r++;
                    $uniqueTagsCheck[] = $tag->getTitle();
                    $uniqueTags[$r]['title'] = $tag->getTitle();
                    $uniqueTags[$r]['id'] = $tag->getId();
                }
            }
        }

        return $this->render('FDevsArticleBundle:Default:categories_tags.html.twig',
            array(
                'categories' => $uniqueCategories,
                'tags' => $uniqueTags,
            )
        );
    }

    public function articleAction(Request $request, $slug)
    {
        $query = $this->getRepository($request)->getArticle($slug);
        $this->setLastModified($request, $query);
        $article = $query->getSingleResult();
        if (!$article) {
            throw new NotFoundHttpException('article Not Found');
        }

        return $this->render('FDevsArticleBundle:Default:article.html.twig', array('article' => $article));
    }

    public function tagAction(Request $request, $tag, $page = 1)
    {
        $query = $this->getRepository($request)->getQueryByTag($tag);
        $this->setLastModified($request, $query);
        $pagination = $this->get('knp_paginator')->paginate($query, $page);

        if (!$pagination->count()) {
            throw new NotFoundHttpException('articles Not Found');
        }

        return $this->render('FDevsArticleBundle:Default:index.html.twig', array('pagination' => $pagination));
    }

    public function categoryAction(Request $request, $category, $page = 1)
    {
        $data = array();
        $data['category'] = $this->get('doctrine_mongodb')->getManager()->find('FDevsArticleBundle:Category', $category);
        if (!$data['category']) {
            throw new NotFoundHttpException('category Not found');
        }
        $query = $this->getRepository($request)->getQueryByCategory($data['category']->getId());
        $this->setLastModified($request, $query);
        $data['pagination'] = $this->get('knp_paginator')->paginate($query, $page);

        return $this->render('FDevsArticleBundle:Default:index.html.twig', $data);
    }

    public function getLastLimitArticleAction(Request $request)
    {
        return $this->render(
            'FDevsArticleBundle:Default:article_limit.html.twig',
            array('articles' => $this->getRepository($request)->setLimit(5)->getQuery()->execute())
        );
    }

    /**
     * get Query Builder Article
     *
     * @param Request $request
     *
     * @return \FDevs\ArticleBundle\Document\ArticleRepository
     *
     * @throws NotFoundHttpException
     */
    private function getRepository(Request $request)
    {
        $repository = $this->container->get('doctrine_mongodb')->getRepository('FDevsArticleBundle:Article');

        if ($username = User::getUsernameByRequest($request)) {
            $user = $this->get('fos_user.user_manager')->findUserByUsername($username);
            if (!$user) {
                throw new NotFoundHttpException('user Not Found');
            }
            $repository->setUserId($user->getId());
        }

        return $repository;
    }

    /**
     * get Last Modified
     *
     * @param Request $request
     * @param Query   $query
     *
     * @return Response
     */
    private function setLastModified(Request $request, Query $query)
    {
        $lastModified = $this->getRepository($request)->getLastModified($query);
        $this->container->get('f_devs_article.event_listener.cache_request')->saveLastModified($lastModified, $request);

        return $this;
    }
}
