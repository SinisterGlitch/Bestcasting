<?php

namespace EavBundle\Service\Eav;

use Doctrine\ORM\EntityManager;

/**
 * Class EavManager
 * @package EavBundle\Service\Eav
 */
class EavManager
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * EavManager constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}
