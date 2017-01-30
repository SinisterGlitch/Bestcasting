<?php

namespace EavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="product_attribute_value_option")
 * @ORM\Entity(repositoryClass="CatalogBundle\Entity\Repository\OptionRepository")
 */
class Option extends EavOption
{
}
