<?php

namespace CoreBundle\Controller;

use FOS\RestBundle\Controller\Annotations\NamePrefix;

/**
 * Class DefaultController
 * @package CoreBundle\Controller
 * @NamePrefix("core_default_")
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