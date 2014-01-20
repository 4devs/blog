<?php

namespace FDevs\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FDevsCommonBundle:Default:index.html.twig', array('name' => $name));
    }

    public function aboutUsAction()
    {
        /* $response Symfony\Component\HttpFoundation\Response */
        $response = $this->render('FDevsCommonBundle:Default:about_us.html.twig');

        // TODO: add cache headers
        return $response;
    }
}
