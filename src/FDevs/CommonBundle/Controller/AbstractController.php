<?php
namespace FDevs\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class AbstractController extends Controller
{
    /**
     * @return \Symfony\Component\Translation\TranslatorInterface
     */
    public function getTranslator() {
        return $this->get('translator');
    }

    /**
     * @param string $itemTransExpr
     * @param string $itemTransDomain
     * @param int $count
     * @return NotFoundHttpException
     */
    public function createItemNotFoundException($itemTransExpr, $itemTransDomain, $count = 1)
    {
        return $this->createNotFoundException($this->getTranslator()->transChoice($itemTransExpr, $count, [], $itemTransDomain));
    }
} 