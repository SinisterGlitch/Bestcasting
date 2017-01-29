<?php

namespace EavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Table(name="eav_entity_attribute")
 * @ORM\Entity(repositoryClass="EavBundle\Entity\Repository\EavRepository")
 */
class EavAttribute
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
     * Constructor
     */
    public function __construct()
    {
        $this->screens = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
