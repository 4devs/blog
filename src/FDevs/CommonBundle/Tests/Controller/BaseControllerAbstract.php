<?php

namespace FDevs\CommonBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Routing\Router;

abstract class BaseControllerAbstract extends WebTestCase
{

    /**
     * init
     */
    public function __construct()
    {
        $this->getClient();
    }

    /**
     * get Client
     *
     * @return \Symfony\Bundle\FrameworkBundle\Client
     */
    public function getClient()
    {
        return static::createClient();
    }

    /**
     * get Container
     *
     * @return \Symfony\Component\DependencyInjection\ContainerInterface
     */
    public function getContainer()
    {
        return static::$kernel->getContainer();
    }

    /**
     * generate Path
     *
     * @param  string $name
     * @param  array  $parameters
     * @param  bool   $referenceType
     * @return string
     */
    public function generatePath($name, $parameters = array(), $referenceType = Router::ABSOLUTE_PATH)
    {
        return $this->getContainer()->get('router')->generate($name, $parameters, $referenceType);
    }
}
