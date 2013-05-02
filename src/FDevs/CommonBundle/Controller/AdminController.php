<?php

namespace FDevs\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function elfinderAction()
    {
        $parameters = $this->container->getParameter('fm_elfinder');

        return $this->render('FDevsCommonBundle:Admin:elfinder.html.twig', array('locale' => $parameters['locale'], 'fullscreen' => $parameters['fullscreen']));
    }
}
