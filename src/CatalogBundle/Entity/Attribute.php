<?php

namespace CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EavBundle\Entity\EavAttribute;

/**
 * @ORM\Table(name="product_attribute")
 * @ORM\Entity(repositoryClass="CatalogBundle\Entity\Repository\AttributeRepository")
 * @ORM\MappedSuperclass()
 */
class Attribute extends EavAttribute
{
    /**
     * @var Group
     * @ORM\ManyToMany(targetEntity="CatalogBundle\Entity\Product", mappedBy="attributes")
     */
    protected $group;

    /**
     * @var Value
     * @ORM\OneToOne(targetEntity="CatalogBundle\Entity\Value", mappedBy="value")
     */
    protected $value;
}
