<?php

namespace ManageBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

/**
 * Class DefaultController
 * @package ManageBundle\Controller
 */
class DefaultController extends FOSRestController
{
    /**
     * @return array
     */
    public function getIndexAction()
    {
        return ['rest'];
    }
}