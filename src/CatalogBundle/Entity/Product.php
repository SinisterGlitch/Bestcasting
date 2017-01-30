<?php

namespace CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EavBundle\Entity\EavEntity;

/**
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="CatalogBundle\Entity\Repository\ProductRepository")
 * @ORM\MappedSuperclass()
 */
class Product extends EavEntity
{
    /**
     * @var Group[]
     * @ORM\ManyToMany(targetEntity="CatalogBundle\Entity\Group", mappedBy="product")
     */
    protected $groups;
}
