<?php
/**
 * @author Andrey Samusev <Andrey.Samusev@exigenservices.com>
 * @copyright andrey 5/1/13
 * @version 1.0.0
 */

namespace FDevs\ArticleBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use FDevs\ArticleBundle\DataFixtures\LoremIpsum;
use FDevs\ArticleBundle\Document\Article;

class LoadArticleData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $paragraphs = LoremIpsum::getRandomParagraphs(250, 1000);
        foreach ($paragraphs as $paragraph) {
            $article = new Article();
            $title = substr($paragraph, 0, mt_rand(1,50));
            $article->setId(strtolower(preg_replace("#\W+#", '-', trim($title))));
            $article->setTitle($title);
            $article->setContent($paragraph);
            $article->setCreatedAt(new \DateTime("yesterday"));
            $article->setPublish(true);
            $article->setRating(mt_rand(0, 100));
            $article->setPublishedAt(new \DateTime());
            $article->addTag($this->getReference('tag'));
            $article->addCategorie($this->getReference('category'));
            $manager->persist($article);
        }
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 99;
    }

}