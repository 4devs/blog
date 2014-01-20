<?php

/**
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace FDevs\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @author Victor Melnik <melnikvictorl@gmail.com>
 */
class AuthorController extends Controller
{

    /**
     * Shows author's personal page
     *
     * @param  string                                     $username
     * @return Symfony\Component\HttpFoundation\Response;
     * @throws NotFoundHttpException
     */
    public function indexAction($username)
    {
        $um = $this->get('fos_user.user_manager');
        $user = $um->findUserByUsername($username);

        if (!$user) {
            throw new NotFoundHttpException('Author not found');
        }

        return $this->render('FDevsUserBundle:Author:index.html.twig', array('user' => $user));
    }

}
