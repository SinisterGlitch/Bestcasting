<?php

namespace CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EavBundle\Entity\EavEntity;

/**
 * @ORM\Table(name="product_attribute_group")
 * @ORM\Entity(repositoryClass="CatalogBundle\Entity\Repository\ProductRepository")
 * @ORM\MappedSuperclass()
 */
class Group extends EavEntity
{
    /**
     * @var Attribute[]
     * @ORM\ManyToMany(targetEntity="CatalogBundle\Entity\Attribute", mappedBy="product")
     */
    protected $attributes;
}
