<?php

namespace EavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
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
     * @var EavEntity
     * @ORM\ManyToOne(targetEntity="EavBundle\Entity\EavEntity", inversedBy="attributes")
     **/
    private $entity;

    /**
     * @var EavValue
     * @ORM\OneToOne(targetEntity="EavBundle\Entity\EavValue", inversedBy="attributes")
     **/
    private $value;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return EavEntity
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param EavEntity $entity
     * @return $this
     */
    public function setEntity(EavEntity $entity)
    {
        $this->entity = $entity;

        return $this;
    }
}
