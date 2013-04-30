<?php

namespace FDevs\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FDevsArticleBundle:Default:index.html.twig', array('name' => $name));
    }
}
