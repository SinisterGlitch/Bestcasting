<?php

namespace EavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Table(name="eav_entity_attribute_value_option")
 * @ORM\Entity(repositoryClass="EavBundle\Entity\Repository\EavRepository")
 */
class EavOption
{
    /**
     * @var integer
     * @Groups({"list", "details"})
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
