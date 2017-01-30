<?php

namespace CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EavBundle\Entity\EavValue;

/**
 * @ORM\Table(name="product_attribute_value")
 * @ORM\Entity(repositoryClass="CatalogBundle\Entity\Repository\ValueRepository")
 * @ORM\MappedSuperclass()
 */
class Value extends EavValue
{
    /**
     * @var Attribute[]
     * @ORM\OneToMany(targetEntity="CatalogBundle\Entity\Attribute", mappedBy="value")
     */
    protected $attribute;
}
