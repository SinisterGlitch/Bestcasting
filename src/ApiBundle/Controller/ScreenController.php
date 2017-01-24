<?php

namespace ApiBundle\Controller;

use CastingBundle\Entity\Screen;
use CastingBundle\Entity\Repository\ScreenRepository;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\Patch;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ScreenController
 * @NamePrefix("api_screen_")
 * @package ApiBundle\Controller
 */
class ScreenController extends BaseController
{
    /**
     * @Get("{id}")
     * @param integer $id
     * @return array
     */
    public function getScreenAction($id)
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
    public function getScreensAction()
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
    public function postScreenAction(Request $request)
    {
        $entity = $this->deserialize(new Screen(), $request->getContent(), 'details');

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
    public function putScreenAction($id, Request $request)
    {
        $entity = $this->getRepository()->find($id);

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
    public function patchScreenAction($id, Request $request)
    {
        $entity = $this->getRepository()->find($id);

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
    public function deleteScreenAction($id)
    {
        $entity = $this->getRepository()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException();
        }

        $this->getManager()->remove($entity);
        $this->getManager()->flush();

        return [];
    }

    /**
     * @return ScreenRepository
     */
    private function getRepository()
    {
        return $this->getManager()->getRepository('CastingBundle:Screen');
    }
}