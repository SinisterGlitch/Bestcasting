<?php

namespace ApiBundle\Controller;

use EavBundle\Entity\EavEntity;
use EavBundle\Entity\Repository\EavEntityRepository;
use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\Patch;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Security\UserManager;

/**
 * Class AttributeController
 * @package ApiBundle\Controller
 * @NamePrefix("api_attribute_")
 */
class AttributeController extends BaseController
{
    /**
     * @Get("{id}")
     * @param integer $id
     * @return array
     */
    public function getUserAction($id)
    {
        $entity = $this->getRepository()->getEntitiesByClassAndId('attribute', $id);

        if (!$entity) {
            throw $this->createNotFoundException();
        }

        return $this->serialize($entity, 'details');
    }

    /**
     * @Get("")
     * @return array
     */
    public function getUsersAction()
    {
        $models = [];
        foreach ($this->getRepository()->getEntitiesByClass('attribute') as $entity) {
            $models[] = $this->serialize($entity, 'list');
        }

        return $models;
    }

    /**
     * @Post("")
     * @param Request $request
     * @return array
     */
    public function postUserAction(Request $request)
    {
        $entity = $this->deserialize(new EavEntity(), $request->getContent(), 'details');

        $this->getManager()->persist($entity);
        $this->getManager()->flush();

        return $this->serialize($entity, 'details');
    }

    /**
     * @Put("{id}")
     * @param integer $id
     * @param Request $request
     * @return array
     */
    public function putUserAction($id, Request $request)
    {
        $entity = $this->getSerializer()->reference(new EavEntity(), $id);

        if (!$entity) {
            throw $this->createNotFoundException();
        }

        $entity = $this->deserialize($entity, $request->getContent(), 'details', true);

        $this->getManager()->merge($entity);
        $this->getManager()->flush();

        return $this->serialize($entity, 'details');
    }

    /**
     * @Patch("{id}")
     * @param integer $id
     * @param Request $request
     * @return array
     */
    public function patchUserAction($id, Request $request)
    {
        $entity = $this->getRepository()->getEntitiesByClassAndId('attribute', $id);

        if (!$entity) {
            throw $this->createNotFoundException();
        }

        $entity = $this->deserialize($entity, $request->getContent(), 'details');

        $this->getManager()->persist($entity);
        $this->getManager()->flush();

        return $this->serialize($entity, 'details');
    }

    /**
     * @Delete("{id}")
     * @param integer $id
     * @return array
     */
    public function deleteUserAction($id)
    {
        $entity = $this->getSerializer()->reference(new EavEntity(), $id);

        if (!$entity) {
            throw $this->createNotFoundException();
        }

        $this->getManager()->remove($entity);
        $this->getManager()->flush();

        return [];
    }

    /**
     * @return EavEntityRepository
     */
    private function getRepository()
    {
        return $this->getManager()->getRepository('EavBundle:EavEntity');
    }

    /**
     * @return UserManager
     */
    public function getUserManager()
    {
        return $this->get('user.user.manager');
    }
}
