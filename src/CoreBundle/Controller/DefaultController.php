<?php

namespace CoreBundle\Controller;

/**
 * Class DefaultController
 * @package CoreBundle\Controller
 */
class DefaultController extends BaseController
{
    /**
     * @return array
     */
    public function getIndexAction()
    {
        return ['rest'];
    }
}