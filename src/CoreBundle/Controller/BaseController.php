<?php

namespace CoreBundle\Controller;

use ApiBundle\Service\Serializer\SerializerManager;
use FOS\RestBundle\Controller\FOSRestController;

/**
 * Class BaseController
 * @package CoreBundle\Controller
 */
class BaseController extends FOSRestController
{
    /**
     * @param mixed $entity
     * @param array|null $groups
     * @param bool $allowNull
     * @return mixed
     */
    protected function serialize($entity, $groups = null, $allowNull = false)
    {
        return $this->getSerializer()->serialize($entity, $groups, $allowNull);
    }

    /**
     * @param mixed $entity
     * @param array $content
     * @param array|null $groups
     * @param bool $allowNull
     * @return mixed
     */
    protected function deserialize($entity, $content, $groups = null, $allowNull = false)
    {
        return $this->getSerializer()->deserialize($entity, $content, $groups, $allowNull);
    }

    /**
     * @return SerializerManager
     */
    private function getSerializer()
    {
        return $this->get('core.serializer.manager');
    }
}