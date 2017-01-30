<?php

namespace EavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="product_attribute")
 * @ORM\Entity(repositoryClass="CatalogBundle\Entity\Repository\AttributeRepository")
 */
class Attribute extends EavAttribute
{
}
