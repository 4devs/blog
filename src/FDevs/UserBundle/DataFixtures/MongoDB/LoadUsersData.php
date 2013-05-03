<?php

/**
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace FDevs\UserBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use FDevs\UserBundle\Document\User;

/**
 * @author Victor Melnik <melnikvictorlx@@gmail.com>
 */
class LoadUsersData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        $fDevs = array(
            array(
                'email' => 'melnikvictorl@gmail.com',
                'username' => 'victor',
                'pwd' => '123',
                'name' => 'Victor',
            ),
            array(
                'email' => 'i.trancer@gmail.com',
                'username' => 'axsy',
                'pwd' => '1234',
                'name' => 'Aleksey',
            ),
            array(
                'email' => 'andrey@4devs.local',
                'username' => 'andrey',
                'pwd' => '456',
                'name' => 'Andrey',
            ),
            array(
                'email' => 'maxim@4devs.local',
                'username' => 'maxim',
                'pwd' => '789',
                'name' => 'Maxim',
            ),
            array(
                'email' => 'psdcoder@gmail.com',
                'username' => 'psdcoder',
                'pwd' => '101112',
                'name' => 'Pavel',
            ),
        );

        foreach ($fDevs as $dev) {
            $user = new User();
            $user->setEmail($dev['email']);
            $user->setEnabled(true);
            $user->setFirstName($dev['name']);
            $user->setPlainPassword($dev['pwd']);
            $user->setUsername($dev['username']);
            $user->setRoles(array('ROLE_ADMIN'));

            $manager->persist($user);
        }

        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }

}