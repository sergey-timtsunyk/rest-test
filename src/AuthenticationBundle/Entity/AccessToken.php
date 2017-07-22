<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 22.07.17
 * Time: 13:28
 */

namespace AuthenticationBundle\Entity;

use FOS\OAuthServerBundle\Entity\AccessToken as BaseAccessToken;

class AccessToken extends BaseAccessToken
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