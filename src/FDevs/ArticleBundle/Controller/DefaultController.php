<?php
namespace FDevs\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    public function indexAction($page = 1, $username = '')
    {
        $pagination = $this->get('knp_paginator')->paginate($this->getRepository($username)->getQuery(), $page);

        return $this->render('FDevsArticleBundle:Default:index.html.twig', array('pagination' => $pagination));
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

    public function articleAction($slug, $username = '')
    {
        $article = $this->getRepository($username)->find($slug);
        if (!$article) {
            throw new NotFoundHttpException('article Not Found');
        }

        return $this->render('FDevsArticleBundle:Default:article.html.twig', array('article' => $article));
    }

    public function tagAction($tag, $page = 1, $username = '')
    {
        $pagination = $this->get('knp_paginator')->paginate(
            $this->getRepository($username)->getQueryByTag($tag),
            $page
        );

        if (!$pagination->count()) {
            throw new NotFoundHttpException('articles Not Found');
        }

        return $this->render('FDevsArticleBundle:Default:index.html.twig', array('pagination' => $pagination));
    }

    public function categoryAction($category, $page = 1, $username = '')
    {
        $category = $this->get('doctrine_mongodb')->getManager()->find('FDevsArticleBundle:Category', $category);
        if (!$category) {
            throw new NotFoundHttpException('category Not found');
        }

        $pagination = $this->get('knp_paginator')->paginate(
            $this->getRepository($username)->getQueryByCategory($category->getId()),
            $page
        );

        return $this->render('FDevsArticleBundle:Default:index.html.twig', array('pagination' => $pagination));
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
     * @param  string                                          $username
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
}
