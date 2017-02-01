<?php

namespace EavBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use EavBundle\Entity\EavEntity;

/**
 * Class EavEntityRepository
 * @package EavBundle\Entity\Repository
 */
class EavEntityRepository extends EntityRepository
{
    /**
     * @param string $class
     * @return EavEntity[]
     */
    public function getEntitiesByClass($class)
    {
        return $this->findBy(['class' => $class]);
    }

    /**
     * @param string $class
     * @param integer $id
     * @return EavEntity[]
     */
    public function getEntitiesByClassAndId($class, $id)
    {
        return $this->findBy(['class' => $class, 'id' => $id]);
    }
}
