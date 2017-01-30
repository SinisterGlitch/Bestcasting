<?php

namespace EavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="product_attribute_value")
 * @ORM\Entity(repositoryClass="CatalogBundle\Entity\Repository\ValueRepository")
 */
class Value extends EavValue
{
}
