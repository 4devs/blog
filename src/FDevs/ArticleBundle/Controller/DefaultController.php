<?php
namespace FDevs\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ODM\MongoDB\Query\Builder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    private $limit = 10;

    public function indexAction($page = 0, $user = false)
    {
        $qb = $this->container->get('doctrine_mongodb')
            ->getManager()
            ->createQueryBuilder('FDevsArticleBundle:Article');
        $this->getSubdomain($qb, $user);
        $articles = $qb
            ->field('publish')->equals(true)
            ->skip($page)->limit($this->limit)
            ->sort('publishedAt', 'desc')
            ->getQuery()
            ->execute();

        return $this->render('FDevsArticleBundle:Default:index.html.twig',
            array(
                'articles' => $articles,
                'pagination' => $this->articlePagination(count($articles), $page, 'article')
            )
        );
    }

    public function getUniqueCategoriesTagsAction($user = false)
    {
        $qb = $this->container->get('doctrine_mongodb')
            ->getManager()
            ->createQueryBuilder('FDevsArticleBundle:Article');
        $this->getSubdomain($qb, $user);
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

    public function articleAction($slug, $user = false)
    {
        $dm = $this->container->get('doctrine_mongodb')->getManager();
        $article = $dm->find('FDevsArticleBundle:Article', $slug);

        if (!$article) {
            throw new NotFoundHttpException('article Not Found');
        }

        return $this->render('FDevsArticleBundle:Default:article.html.twig', array('article' => $article));
    }

    public function tagAction($tag, $page = 0, $user = false)
    {
        $tag = explode('/', $tag);

        $qb = $this->container->get('doctrine_mongodb')
            ->getManager()
            ->createQueryBuilder('FDevsArticleBundle:Article');
        $this->getSubdomain($qb, $user);
        $articles = $qb
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

    public function categoryAction($category, $page = 0, $user = false)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $category = $dm->find('FDevsArticleBundle:Category', $category);
        if (!$category) {
            throw new NotFoundHttpException('category Not found');
        }

        $qb = $dm->createQueryBuilder('FDevsArticleBundle:Article');
        $this->getSubdomain($qb, $user);
        $articles = $qb
            ->field('publish')->equals(true)
            ->field('categories.id')->equals($category->getId())
            ->skip($page)
            ->limit($this->limit)
            ->sort('publishedAt', 'desc')
            ->getQuery()
            ->execute();

        return $this->render('FDevsArticleBundle:Default:index.html.twig',
            array(
                'articles' => $articles,
                'pagination' => $this->articlePagination(count($articles), $page, 'category', $category->getId()),
                'category' => $category
            )
        );
    }

    public function getLastLimitArticleAction($user = false)
    {
        $qb = $this->get('doctrine_mongodb')
            ->getManager()
            ->createQueryBuilder('FDevsArticleBundle:Article');
        $this->getSubdomain($qb, $user);
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

    /**
     * set authors in $qb
     *
     * @param  Builder               $qb
     * @param  bool                  $user
     * @throws NotFoundHttpException
     */
    private function getSubdomain(Builder $qb, $user = false)
    {
        if ($user && $userName = rtrim($user, '.')) {
            $user = $this->get('fos_user.user_manager')->findUserByUsername($userName);
            if (!$user) {
                throw new NotFoundHttpException('user Not Found');
            }
            $qb->field('authors')->exists(true)
                ->field('authors.id')->equals($user->getId());
        }
    }

    private function articlePagination($count, $page, $item, $param = '')
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
}
