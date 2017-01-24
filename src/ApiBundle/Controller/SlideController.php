<?php

namespace ApiBundle\Controller;

use CastingBundle\Entity\Slide;
use CastingBundle\Entity\Repository\SlideRepository;
use FOS\RestBundle\Controller\Annotations\Delete;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\Patch;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SlideController
 * @NamePrefix("api_slide_")
 * @package ApiBundle\Controller
 */
class SlideController extends BaseController
{
    /**
     * @Get("{id}")
     * @param integer $id
     * @return array
     */
    public function getSlideAction($id)
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
    public function getSlidesAction()
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
    public function postSlideAction(Request $request)
    {
        $entity = $this->deserialize(new Slide(), $request->getContent(), 'details');

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
    public function putSlideAction($id, Request $request)
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
    public function patchSlideAction($id, Request $request)
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
    public function deleteSlideAction($id)
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
     * @return SlideRepository
     */
    private function getRepository()
    {
        return $this->getManager()->getRepository('CastingBundle:Slide');
    }
}