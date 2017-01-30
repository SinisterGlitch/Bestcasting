<?php

namespace CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EavBundle\Entity\EavOption;

/**
 * @ORM\Table(name="product_attribute_value_option")
 * @ORM\Entity(repositoryClass="CatalogBundle\Entity\Repository\OptionRepository")
 * @ORM\MappedSuperclass()
 */
class Option extends EavOption
{
    /**
     * @var Attribute[]
     * @ORM\OneToMany(targetEntity="CatalogBundle\Entity\Attribute", mappedBy="value")
     */
    protected $attribute;
}
