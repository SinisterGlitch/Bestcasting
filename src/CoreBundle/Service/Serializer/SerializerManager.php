<?php

namespace CoreBundle\Service\Serializer;

use Doctrine\ORM\EntityManager;
use JMS\Serializer\Context;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class SerializerManager
 * @package CoreBundle\Service\Serializer
 */
class SerializerManager
{
    /**
     * @var string
     */
    const SERIALIZER_TYPE = 'json';

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * @param Serializer $serializer
     * @param ValidatorInterface $validator
     * @param EntityManager $manager
     */
    public function __construct(Serializer $serializer, ValidatorInterface $validator, EntityManager $manager)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->manager = $manager;
    }

    /**
     * @param object $entity
     * @param string $groups
     * @param bool $allowNull
     * @return array
     */
    public function serialize($entity, $groups = null, $allowNull = false)
    {
        $context = new SerializationContext();
        $context->setSerializeNull($allowNull);

        if ($groups) {
            $context->setGroups($groups);
        }

        return $this->serializer->toArray($entity, $context);
    }

    /**
     * @param object $entity
     * @param string $content
     * @param string $groups
     * @param bool $allowNull
     * @return object
     */
    public function deserialize($entity, $content, $groups = null, $allowNull = false)
    {
        $context = new DeserializationContext();
        $context
            ->setAttribute('entity', $entity)
            ->setSerializeNull($allowNull);

        if ($groups) {
            $context->setGroups($groups);
        }

        return $this->construct($entity, $content, $context);
    }

    /**
     * @param object $entity
     * @param integer $id
     * @return object
     */
    public function reference($entity, $id)
    {
        return $this->manager->getPartialReference(get_class($entity), $id);
    }

    /**
     * @param object $entity
     * @return ConstraintViolationListInterface
     */
    public function validate($entity)
    {
        return $this->validator->validate($entity);
    }

    /**
     * @param object $entity
     * @param string $content
     * @param Context $context
     * @return object
     */
    private function construct($entity, $content, Context $context)
    {
        return $this->serializer->deserialize($content, get_class($entity), self::SERIALIZER_TYPE, $context);
    }
}
