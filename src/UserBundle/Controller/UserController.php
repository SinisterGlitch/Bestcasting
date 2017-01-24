<?php

namespace UserBundle\Controller;

use CoreBundle\Controller\BaseController;
use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\Patch;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Repository\UserRepository;
use UserBundle\Entity\User;
use UserBundle\Security\UserManager;

/**
 * Class UserController
 * @package UserBundle\Controller
 * @NamePrefix("user_user_")
 */
class UserController extends BaseController
{
    /**
     * @Get("{id}")
     * @param integer $id
     * @return array
     */
    public function getSingleAction($id)
    {
        $entity = $this->getRepository()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException();
        }

        return $this->serialize($entity, 'details');
    }

    /**
     * @Get("")
     * @return array
     */
    public function getAllAction()
    {
        $models = [];
        foreach ($this->getRepository()->findAll() as $entity) {
            $models[] = $this->serialize($entity, 'list');
        }

        return $models;
    }

    /**
     * @Post("")
     * @param Request $request
     * @return array
     */
    public function postAction(Request $request)
    {
        $entity = $this->deserialize(new User, $request->getContent(), 'details');
        $entity = $this->getUserManager()->register($entity);

        return $this->serialize($entity, 'details');
    }

    /**
     * @Put("{id}")
     * @param integer $id
     * @param Request $request
     * @return array
     */
    public function putAction($id, Request $request)
    {
        $entity = $this->getSerializer()->reference(new User(), $id);

        if (!$entity) {
            throw $this->createNotFoundException();
        }

        $entity = $this->deserialize($entity, $request->getContent(), 'details', true);
        $entity = $this->getUserManager()->updatePassword($entity);

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
    public function patchAction($id, Request $request)
    {
        $entity = $this->getRepository()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException();
        }

        $password = $entity->getPassword();
        $entity = $this->deserialize($entity, $request->getContent(), 'details');

        if ($entity->getPassword() != $password) {
            $entity = $this->getUserManager()->updatePassword($entity);
        }

        $this->getManager()->persist($entity);
        $this->getManager()->flush();

        return $this->serialize($entity, 'details');
    }

    /**
     * @Delete("{id}")
     *
     * @param integer $id
     * @return array
     */
    public function deleteAction($id)
    {
        $entity = $this->getSerializer()->reference(new User(), $id);

        if (!$entity) {
            throw $this->createNotFoundException();
        }

        $this->getManager()->remove($entity);
        $this->getManager()->flush();

        return [];
    }

    /**
     * @return UserRepository
     */
    private function getRepository()
    {
        return $this->getManager()->getRepository('UserBundle:User');
    }

    /**
     * @return UserManager
     */
    public function getUserManager()
    {
        return $this->get('user.user.manager');
    }
}
