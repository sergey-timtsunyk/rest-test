<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 22.07.17
 * Time: 14:03
 */

namespace AuthenticationBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

class User extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}