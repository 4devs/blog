<?php

namespace FDevs\CommonBundle\Tests\Controller;

class DefaultControllerTest extends BaseControllerAbstract
{
    public function testAboutUs()
    {
        $crawler = $this->getClient()->request('GET', $this->generatePath('fdevs_common_about_us'));

        $this->assertTrue($crawler->filter('title:contains("4devs - blog от разработчиков разработчикам.")')->count() > 0);
    }
}
