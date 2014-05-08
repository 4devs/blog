<?php

namespace FDevs\ArticleBundle\Tests\Controller;

use FDevs\CommonBundle\Tests\Controller\BaseControllerAbstract;

class DefaultControllerTest extends BaseControllerAbstract
{
    public function testIndex()
    {
        $crawler = $this->getClient()->request('GET', $this->generatePath('f_devs_article_homepage'));

        $this->assertTrue($crawler->filter('title:contains("4devs - blog от разработчиков разработчикам.")')->count() > 0);
    }
}
