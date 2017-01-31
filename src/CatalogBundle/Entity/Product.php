<?php

namespace CatalogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use EavBundle\Entity\EavEntity;

/**
 * @ORM\MappedSuperclass()
 * @DiscriminatorMap({"product" = "CatalogBundle\Entity\Product"})
 */
class Product extends EavEntity
{
}