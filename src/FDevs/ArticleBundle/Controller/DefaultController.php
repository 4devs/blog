<?php
namespace FDevs\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    public $limit = 10;


    public function indexAction($page = 0)
    {
        $qb = $this->container->get('doctrine_mongodb')
            ->getManager()
            ->createQueryBuilder('FDevsArticleBundle:Article');
        $articles = $qb
            ->field('publish')->equals(true)
            ->skip($page)
            ->limit($this->limit)
            ->sort('createdAt', 'desc')
            ->getQuery()
            ->execute();


        return $this->render('FDevsArticleBundle:Default:index.html.twig',
            array(
                'articles' => $articles,
                'pagination' => $this->articlePagination(count($articles), $page, 'article')
            )
        );
    }

    public function articlePagination($count, $page, $item, $param = '')
    {
        $countArticleFloor = floor($count / $this->limit);

        if($count > $this->limit){
            return $this->renderView('FDevsArticleBundle:Default:pagination.html.twig',
                array(
                    'countArticleFloor' => $countArticleFloor,
                    'limit' => $this->limit,
                    'prev' => ($page >= $this->limit) ? $page - $this->limit : '',
                    'next' => ($page >= $this->limit) || ($page == 0) ? $page + $this->limit : '',
                    'param' => $param,
                    'page' => $page,
                    'item' => $item
                )
            );
        }
    }

    public function getAllCategoriesAction()
    {

        $qb = $this->container->get('doctrine_mongodb')
            ->getManager()
            ->createQueryBuilder('FDevsArticleBundle:Category');
        $categories = $qb
            ->getQuery()
            ->execute();

        return $this->render('FDevsArticleBundle:Default:categories.html.twig',
            array(
                'categories' => $categories,
            )
        );
    }

    public function getAllTagsAction()
    {

        $qb = $this->container->get('doctrine_mongodb')
            ->getManager()
            ->createQueryBuilder('FDevsArticleBundle:Tag');
        $tags = $qb
            ->getQuery()
            ->execute();

        return $this->render('FDevsArticleBundle:Default:tags.html.twig',
            array(
                'tags' => $tags,
            )
        );
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
        $tag = explode('/', $tag);
        $articles = $this->container->get('doctrine_mongodb')
            ->getManager()
            ->createQueryBuilder('FDevsArticleBundle:Article')
            ->field('publish')->equals(true)
            ->field('tags.id')->equals($tag[0])
            ->skip(!empty($tag[1]) ? $tag[1] : $page)
            ->limit(20)
            ->sort('createdAt', 'desc')
            ->getQuery()
            ->execute();

        if (!$articles->count()) {
            throw new NotFoundHttpException('articles Not Found');
        }

        return $this->render('FDevsArticleBundle:Default:index.html.twig',
            array(
                'articles' => $articles,
                'pagination' => $this->articlePagination(count($articles), !empty($tag[1]) ? $tag[1] : $page, 'tag', $param = $tag[0])
            )
        );
    }

    public function categoryAction($category, $page = 0)
    {

        $category = explode('/', $category);

        $articles = $this->container->get('doctrine_mongodb')
            ->getManager()
            ->createQueryBuilder('FDevsArticleBundle:Article')
            ->field('publish')->equals(true)
            ->field('categories.id')->equals($category[0])
            ->skip(!empty($category[1]) ? $category[1] : $page)
            ->limit($this->limit)
            ->sort('createdAt', 'desc')
            ->getQuery()
            ->execute();


        if (!$articles->count()) {
            throw new NotFoundHttpException('articles Not Found');
        }

        return $this->render('FDevsArticleBundle:Default:index.html.twig',
            array(
                'articles' => $articles,
                'pagination' => $this->articlePagination(count($articles), !empty($category[1]) ? $category[1] : $page, 'category', $param = $category[0])
            )
        );
    }

    public function getLastLimitArticleAction()
    {
        $qb = $this->container->get('doctrine_mongodb')
            ->getManager()
            ->createQueryBuilder('FDevsArticleBundle:Article');
        $articles = $qb
            ->field('publish')->equals(true)
            ->limit(5)
            ->sort('createdAt', 'desc')
            ->getQuery()
            ->execute();


        return $this->render('FDevsArticleBundle:Default:article_limit.html.twig',
            array(
                'articles' => $articles,
            )
        );
    }
}