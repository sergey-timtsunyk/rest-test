<?php

namespace AuthenticationBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

class DefaultController extends FOSRestController
{

    public function getHelloAction()
    {
        $data = array("hello" => "world");
        $view = $this->view($data);
        return $this->handleView($view);
    }

    public function indexAction()
    {
        return $this->render('AuthenticationBundle:Default:index.html.twig');
    }
}
