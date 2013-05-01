<?php
namespace FDevs\ArticleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FDevsArticleBundle:Default:index.html.twig', array('name' => '123'));
    }

    public function helloAction($name)
    {
        return $this->render('FDevsArticleBundle:Default:index.html.twig', array('name' => $name));
    }
}
