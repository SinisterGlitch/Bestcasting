<?php

namespace CoreBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;

/**
 * Class DefaultController
 * @package CoreBundle\Controller
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