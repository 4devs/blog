<?php

/**
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace FDevs\CommonBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use FDevs\CommonBundle\Event\ConfigureMenuEvent;

/**
 * Common builder for site menu
 * 
 * @author Victor Melnik <melnikvictorl@gmail.com>
 */
class Builder extends ContainerAware
{

    /**
     * Build main site menu
     * 
     * @param \Knp\Menu\FactoryInterface $factory
     * @param array $options
     * 
     * @return Knp\Menu\ItemInterface
     */
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $this->setCurrentItem($menu);
        
        $menu->setChildrenAttribute('class', 'nav');
        $menu->setExtra('currentElement', 'active');

        $menu->addChild('main', array(
            'route' => 'f_devs_article_homepage',
            'label' => 'Главная',
        ));
        $menu->addChild('about_us', array(
            'route' => 'fdevs_common_about_us',
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

        $this->addHook(ConfigureMenuEvent::CONFIGURE, $factory, $menu);

        return $menu;
    }

    /**
     * Builds sidebar menu
     * 
     * @param \Knp\Menu\FactoryInterface $factory
     * @param array $options
     * 
     * @return \Knp\Menu\ItemInterface
     */
    public function sideBar(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $this->setCurrentItem($menu);
        
        $menu->setChildrenAttribute('class', 'dropdown-menu');

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

        $this->addHook(ConfigureMenuEvent::CONFIGURE_SIDEBAR, $factory, $menu);

        return $menu;
    }

    /**
     * Shortcut for getting user
     * 
     * @return \FOS\UserBundle\Model\UserInterface
     */
    protected function getUser()
    {
        return $this->container->get('security.context')->getToken()->getUser();
    }

    /**
     * Adds hook to extend/rebuild menu with this hook
     * 
     * @param string $hook_name
     * @param \Knp\Menu\FactoryInterface $factory
     * @param \Knp\Menu\ItemInterface $menu
     */
    protected function addHook($hook_name, FactoryInterface $factory, ItemInterface $menu)
    {
        $this->container->get('event_dispatcher')
                ->dispatch($hook_name, new ConfigureMenuEvent($factory, $menu));
    }
    
    /**
     * KnpMenu 1.1.x branch approach to set current item for menu
     * 
     * @param \Knp\Menu\ItemInterface $menu
     */
    protected function setCurrentItem(ItemInterface $menu)
    {
        $menu->setCurrentUri($this->container->get('request')->getPathInfo());
    }

}