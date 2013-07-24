<?php
namespace FDevs\ArticleBundle\Controller;

use FDevs\ArticleBundle\Model\Category;
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
            ->sort('publishedAt', 'desc')
            ->getQuery()
            ->execute();

        $breadCrumbs = $this->container->get('bread_crumbs');
        $breadCrumbs->addItem('Главная', $this->generateUrl('f_devs_article_homepage'));

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

        if ($count > $this->limit) {
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


    public function getUniqueCategoriesTagsAction()
    {
        $qb = $this->container->get('doctrine_mongodb')
            ->getManager()
            ->createQueryBuilder('FDevsArticleBundle:Article');
        $tags = $qb
            ->field('publish')->equals(true)
            ->getQuery()
            ->execute();

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

    public function articleAction($slug)
    {
        $dm = $this->container->get('doctrine_mongodb')->getManager();
        $article = $dm->find('FDevsArticleBundle:Article', $slug);
        $breadCrumbs = $this->get('bread_crumbs');
        $this->breadCrumbs($breadCrumbs, $article->getParentCategory());
//        $this->get('knp_disqus.request')->fetch('')

        $breadCrumbs->addItem($article->getTitle(), '#');
        if (!$article) {
            throw new NotFoundHttpException('article Not Found');
        }
        return $this->render('FDevsArticleBundle:Default:article.html.twig', array('article' => $article));
    }

    public function tagAction($tag, $page = 0)
    {
        $tag = explode('/', $tag);

        $breadCrumbs = $this->container->get('bread_crumbs');
        $breadCrumbs->addItem('Главная', $this->generateUrl('f_devs_article_homepage'));
        $breadCrumbs->addItem($tag[0], $this->generateUrl('f_devs_article_tag', array('tag' => $tag[0])));


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
        $dm = $this->get('doctrine_mongodb')->getManager();
        $category = $dm->find('FDevsArticleBundle:Category', $category);
        if (!$category) {
            throw new NotFoundHttpException('category Not found');
        }
        $breadCrumbs = $this->container->get('bread_crumbs');
        $this->breadCrumbs($breadCrumbs, $category);
        $articles = $dm
            ->createQueryBuilder('FDevsArticleBundle:Article')
            ->field('publish')->equals(true)
            ->field('categories.id')->equals($category->getId())
            ->skip($page)
            ->limit($this->limit)
            ->sort('publishedAt', 'desc')
            ->getQuery()
            ->execute();


        if (!$articles->count()) {
            throw new NotFoundHttpException('articles Not Found');
        }

        return $this->render('FDevsArticleBundle:Default:index.html.twig',
            array(
                'articles' => $articles,
                'pagination' => $this->articlePagination(count($articles), $page, 'category', $category->getId())
            )
        );
    }

    public function getLastLimitArticleAction()
    {
        $qb = $this->get('doctrine_mongodb')
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

    private function breadCrumbs(\FDevs\ArticleBundle\Service\BreadCrumbs $breadCrumbs, Category $category)
    {
        $breadCrumbs->addItem('Главная', $this->generateUrl('f_devs_article_homepage'));
        $crumbs = array($category);
        while ($category = $category->getParent()) {
            array_unshift($crumbs, $category);
        }
        foreach ($crumbs as $val) {
            $breadCrumbs->addItem($val->getTitle(), $this->generateUrl('f_devs_article_category', array('category' => $val->getId())));
        }

        return $breadCrumbs;
    }
}
