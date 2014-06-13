<?php
namespace FDevs\ArticleBundle\Controller;

use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\MongoDB\Query\Builder;
use Doctrine\ODM\MongoDB\Query\Query;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    public function indexAction(Request $request, $page = 1, $username = '')
    {
        $query = $this->getRepository($username)->setPage($page)->getQuery();
        $response = $this->getLastModified('index' . $username . $page, $query);

        if ($response->isNotModified($request)) {
            return $response;
        }
        $pagination = $this->get('knp_paginator')->paginate($this->getRepository($username)->getQuery(), $page);

        return $this->render('FDevsArticleBundle:Default:index.html.twig', array('pagination' => $pagination), $response);
    }

    public function getUniqueCategoriesTagsAction($username = '')
    {
        $tags = $this->getRepository($username)->getQuery()->execute();

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

    public function articleAction(Request $request, $slug, $username = '')
    {
        $query = $this->getRepository($username)->getArticle($slug);
        $response = $this->getLastModified('article' . $username . $slug, $query);
        if ($response->isNotModified($request)) {
            return $response;
        }
        $article = $query->getSingleResult();
        if (!$article) {
            throw new NotFoundHttpException('article Not Found');
        }

        return $this->render('FDevsArticleBundle:Default:article.html.twig', array('article' => $article), $response);
    }

    public function tagAction(Request $request, $tag, $page = 1, $username = '')
    {
        $query = $this->getRepository($username)->getQueryByTag($tag);
        $response = $this->getLastModified('tag' . $tag . $page . $username, $query);
        if ($response->isNotModified($request)) {
            return $response;
        }
        $pagination = $this->get('knp_paginator')->paginate($query, $page);

        if (!$pagination->count()) {
            throw new NotFoundHttpException('articles Not Found');
        }

        return $this->render('FDevsArticleBundle:Default:index.html.twig', array('pagination' => $pagination), $response);
    }

    public function categoryAction(Request $request, $category, $page = 1, $username = '')
    {
        $data = array();
        $data['category'] = $this->get('doctrine_mongodb')->getManager()->find('FDevsArticleBundle:Category', $category);
        if (!$data['category']) {
            throw new NotFoundHttpException('category Not found');
        }
        $query = $this->getRepository($username)->getQueryByCategory($data['category']->getId());
        $response = $this->getLastModified('category' . $category . $page . $username, $query);
        if ($response->isNotModified($request)) {
            return $response;
        }
        $data['pagination'] = $this->get('knp_paginator')->paginate($query, $page);

        return $this->render('FDevsArticleBundle:Default:index.html.twig', $data, $response);
    }

    public function getLastLimitArticleAction($username = '')
    {
        return $this->render(
            'FDevsArticleBundle:Default:article_limit.html.twig',
            array('articles' => $this->getRepository($username)->setLimit(5)->getQuery()->execute())
        );
    }

    /**
     * get Query Builder Article
     *
     * @param  string $username
     * @return \FDevs\ArticleBundle\Document\ArticleRepository
     * @throws NotFoundHttpException
     */
    private function getRepository($username = '')
    {
        $repository = $this->container
            ->get('doctrine_mongodb')
            ->getRepository('FDevsArticleBundle:Article');

        if ($username && $username = rtrim($username, '.')) {
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
     * @param string $cacheId
     * @param Query $query
     *
     * @return Response
     */
    private function getLastModified($cacheId, Query $query)
    {
        $cacheId .= $this->getUser() ? $this->getUser()->getId() : 'anon';
        $cache = $this->container->get('doctrine_cache.providers.base');
        $lastModified = $cache->fetch($cacheId);
        $response = new Response();
        if ($lastModified) {
            $lastModified = unserialize($lastModified);
        } else {
            $lastModified = $this->getRepository()->getLastModified($query);
            $cache->save($cacheId, serialize($lastModified));
        }
        if ($this->container->get('security.context')->isGranted('ROLE_USER')) {
            $response->setLastModified(new \DateTime());
            $response->setPrivate();
        } else {
            $response->setPublic();
            $response->setLastModified($lastModified);
        }

        return $response;
    }
}
