<?php

namespace CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EavBundle\Entity\EavGroup;

/**
 * @ORM\Table(name="product_attribute_group")
 * @ORM\Entity(repositoryClass="CatalogBundle\Entity\Repository\GroupRepository")
 * @ORM\MappedSuperclass()
 */
class Group extends EavGroup
{
    /**
     * @var Attribute[]
     * @ORM\ManyToMany(targetEntity="CatalogBundle\Entity\Attribute", mappedBy="product")
     */
    protected $attributes;
}
