<?php

/**
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace FDevs\UserBundle\Document;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Symfony\Component\HttpFoundation\Request;

/**
 * @MongoDB\Document(collection="fdevs_users"))
 *
 * @author Victor Melnik <melnikvictorl@gmail.com>
 *
 */
class User extends BaseUser
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDB\String
     */
    protected $firstName;

    /**
     * @MongoDB\String
     */
    protected $lastName;

    /**
     * @MongoDB\Hash
     */
    protected $social;

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param  string $firstName
     * @return \User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string $firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param  string $lastName
     * @return \User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string $lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set social
     *
     * @param  hash  $social
     * @return \User
     */
    public function setSocial($social)
    {
        $this->social = $social;

        return $this;
    }

    /**
     * Get social
     *
     * @return hash $social
     */
    public function getSocial()
    {
        return $this->social;
    }

    public function __toString()
    {
        return $this->username ? : "new";
    }

    /**
     * get Usernane By Request
     *
     * @param Request $request
     *
     * @return string
     */
    public static function getUsernameByRequest(Request $request)
    {
        return strtolower(rtrim($request->get('username', ''), '.'));
    }

}
