<?php

/**
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace FDevs\CommonBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * @author Victor Melnik <melnikvictorl@gmail.com>
 */
class Builder extends ContainerAware
{

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav');
        $menu->setExtra('currentElement', 'active');

        $menu->addChild('main', array(
            'route' => 'f_devs_article_homepage',
            'label' => 'Главная',
        ));
        $menu->addChild('about_us', array(
            'route' => 'f_devs_article_homepage',
            'label' => 'О нас',
        ));

        if (!is_object($this->getUser())) {
            $menu->addChild('registration', array(
                'route' => 'fos_user_registration_register',
                'label' => 'Регистрация',
            ));
            $menu->addChild('login', array(
                'route' => 'fos_user_security_login',
                'label' => 'Логин',
            ));
        }

        $this->allowExtend($factory, $menu);

        return $menu;
    }

    public function sideBar(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav nav-list');

        $user = $this->getUser();

        if (is_object($user)) {
            
            $menu->addChild('profile', array(
                'route' => 'fos_user_profile_show',
                'label' => 'Профиль',
            ));
            $menu->addChild('settings', array(
                'route' => 'fos_user_profile_edit',
                'label' => 'Настройки',
            ));
            $menu->addChild('pwd', array(
                'route' => 'fos_user_change_password',
                'label' => 'Пароль',
            ));

            if ($user->hasRole('ROLE_ADMIN')) {
                $menu->addChild('admin_panel', array(
                    'route' => 'sonata_admin_dashboard',
                    'label' => 'Админка',
                ));
            }

            $menu->addChild('exit', array(
                'route' => 'fos_user_security_logout',
                'label' => 'Выход',
            ));
        }

        $this->allowExtend($factory, $menu);

        return $menu;
    }

    protected function getUser()
    {
        return $this->container->get('security.context')->getToken()->getUser();
    }

    protected function allowExtend(FactoryInterface $factory, $menu)
    {
        // TODO: add event
    }

}