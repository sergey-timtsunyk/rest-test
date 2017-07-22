<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 22.07.17
 * Time: 13:29
 */

namespace AuthenticationBundle\Entity;

use FOS\OAuthServerBundle\Entity\RefreshToken as BaseRefreshToken;

class RefreshToken extends BaseRefreshToken
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var User
     */
    protected $user;
}