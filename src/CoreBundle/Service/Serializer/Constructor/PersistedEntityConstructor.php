<?php

namespace CoreBundle\Service\Serializer\Constructor;

use Doctrine\Common\Persistence\ManagerRegistry;
use JMS\Serializer\Construction\ObjectConstructorInterface;
use JMS\Serializer\Context;
use JMS\Serializer\VisitorInterface;
use JMS\Serializer\Metadata\ClassMetadata;
use JMS\Serializer\DeserializationContext;
use PhpOption\None;

/**
 * Class PersistedEntityConstructor
 * @package CoreBundle\Service\Serializer\Constructor
 */
class PersistedEntityConstructor implements ObjectConstructorInterface
{
    /**
     * @var ManagerRegistry
     */
    private $managerRegistry;

    /**
     * @var ObjectConstructorInterface
     */
    private $fallbackConstructor;

    /**
     * @param ManagerRegistry $managerRegistry Manager registry
     * @param ObjectConstructorInterface $fallbackConstructor Fallback object constructor
     */
    public function __construct(ManagerRegistry $managerRegistry, ObjectConstructorInterface $fallbackConstructor)
    {
        $this->managerRegistry = $managerRegistry;
        $this->fallbackConstructor = $fallbackConstructor;
    }

    /**
     * {@inheritdoc}
     */
    public function construct(VisitorInterface $visitor, ClassMetadata $metadata, $data, array $type, DeserializationContext $context)
    {
        $objectManager = $this->managerRegistry->getManagerForClass($metadata->name);
        if (!$objectManager) {
            return $this->fallbackConstructor->construct($visitor, $metadata, $data, $type, $context);
        }

        $classMetadataFactory = $objectManager->getMetadataFactory();

        if ($classMetadataFactory->isTransient($metadata->name)) {
            return $this->fallbackConstructor->construct($visitor, $metadata, $data, $type, $context);
        }

        if (!is_array($data)) {
            return $objectManager->getReference($metadata->name, $data);
        }

        $classMetadata = $objectManager->getClassMetadata($metadata->name);

        $identifierList = [];
        foreach ($classMetadata->getIdentifierFieldNames() as $name) {
            $identifier = $this->getIdentifierFromContext($context, $name, $type);

            if (!array_key_exists($name, $data)) {
                if ($identifier) {
                    $identifierList[$name] = $identifier;
                    break;
                }

                return $this->fallbackConstructor->construct($visitor, $metadata, $data, $type, $context);
            }

            $identifierList[$name] = $data[$name];
        }

        $object = $objectManager->find($metadata->name, $identifierList);

        $objectManager->initializeObject($object);

        return $object;
    }

    /**
     * @param Context $context
     * @param string $identifier
     * @param array $type
     * @return int|null|string
     */
    private function getIdentifierFromContext(Context $context, $identifier, $type)
    {
        $result = null;
        $entity = $this->getEntityFromContext($context);
        if ($entity && $this->isRootClass($context, $type) && method_exists($entity, $this->getIdentifierMethod($identifier))) {
            $id = $entity->{$this->getIdentifierMethod($identifier)}();

            if (!empty($id)) {
                $result = $id;
            }
        }

        return $result;
    }

    /**
     * @param Context $context
     * @return object
     */
    private function getEntityFromContext(Context $context)
    {
        $entity = $context->attributes->get('entity');

        $result = null;
        if (!$context->attributes->get('entity') instanceof None) {
            $result = $entity->get('value');
        }

       return $result;
    }

    /**
     * @param string $identifier
     * @return string
     */
    private function getIdentifierMethod($identifier)
    {
        return 'get' . ucfirst($identifier);
    }

    /**
     * @param Context $context
     * @param array $type
     * @return bool
     */
    private function isRootClass(Context $context, $type)
    {
        return get_class($this->getEntityFromContext($context)) == $type['name'];
    }
}
