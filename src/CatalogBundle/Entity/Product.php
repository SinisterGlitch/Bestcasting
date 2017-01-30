<?php

namespace EavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="CatalogBundle\Entity\Repository\ProductRepository")
 */
class Product extends EavEntity
{
}
