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
use FDevs\ArticleBundle\Document\Category;
use FDevs\ArticleBundle\DataFixtures\LoremIpsum;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $paragraph = LoremIpsum::getParagraph();
        $categories = explode(' ', $paragraph);
        $parent = null;
        foreach ($categories as $category) {
            if ($category) {
                $categoryModel = new Category();
                $categoryModel->setCreatedAt(new \DateTime());
                $categoryModel->setTitle($category);
                if ($parent) {
                    $categoryModel->setParent($parent);
                    $parent = null;
                } else {
                    $parent = $categoryModel;
                }
                $categoryModel->setId(strtolower(trim($category, '.')));
                $manager->persist($categoryModel);
                $this->setReference('category', $categoryModel);
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
