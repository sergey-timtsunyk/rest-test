<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 22.07.17
 * Time: 13:28
 */

namespace AuthenticationBundle\Entity;

use FOS\OAuthServerBundle\Entity\Client as BaseClient;

class Client extends BaseClient
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }
}