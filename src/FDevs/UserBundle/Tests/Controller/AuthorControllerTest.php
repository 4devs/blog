<?php

namespace FDevs\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/u/Fabien');
        $code = $client->getResponse()->getStatusCode();
        $this->assertEquals(404,$code);
    }
}
