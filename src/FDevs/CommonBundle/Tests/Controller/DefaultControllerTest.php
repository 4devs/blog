<?php

namespace FDevs\CommonBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testAboutUs()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/about-us');

        $this->assertTrue($crawler->filter('title:contains("4devs - blog от разработчиков разработчикам.")')->count() > 0);
    }
}
