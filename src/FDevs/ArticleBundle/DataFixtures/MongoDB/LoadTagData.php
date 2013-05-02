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
use FDevs\ArticleBundle\Document\Tag;

class LoadTagData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $paragraph = LoremIpsum::getParagraph();
        $tags = explode(' ', $paragraph);
        $referenceTags = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($tags as $tag) {
            if ($tag) {
                $tagModel = new Tag();
                $tagModel->setCreatedAt(new \DateTime());
                $tagModel->setTitle($tag);
                $tagModel->setId(strtolower($tag));
                $referenceTags->add($tagModel);
                $manager->persist($tagModel);
                $this->setReference('tag', $tagModel);
            }
        }
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }

}