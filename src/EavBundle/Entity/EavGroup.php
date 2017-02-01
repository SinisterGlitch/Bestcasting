<?php

namespace EavBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;

/**
 * @ORM\Table(name="entity_attribute_group")
 * @ORM\Entity(repositoryClass="EavBundle\Entity\Repository\EavGroupRepository")
 */
class EavGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"details", "list"})
     * @Type("integer")
     * @var integer
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="code", type="string")
     * @Groups({"details", "list"})
     * @Type("string")
     */
    protected $code;

    /**
     * @var EavEntity
     * @ORM\ManyToOne(targetEntity="EavBundle\Entity\EavEntity", inversedBy="groups", cascade={"persist"})
     * @Type("EavBundle\Entity\EavAttribute")
     * @Groups({"details", "list"})
     */
    protected $entity;

    /**
     * @var EavAttribute[]
     * @ORM\ManyToMany(targetEntity="EavBundle\Entity\EavAttribute", inversedBy="groups", cascade={"persist"})
     * @Type("ArrayCollection<EavBundle\Entity\EavAttribute>")
     * @Groups({"details", "list"})
     */
    protected $attributes;

    /**
     * EavGroup constructor.
     */
    public function __construct()
    {
        $this->attributes = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return EavAttribute[]
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param EavAttribute[] $attributes
     * @return $this
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * @param EavAttribute $attributes
     * @return $this
     */
    public function addAttribute(EavAttribute $attributes)
    {
        $this->attributes[] = $attributes;

        return $this;
    }

    /**
     * @param EavAttribute $attributes
     */
    public function removeAttribute(EavAttribute $attributes)
    {
        $this->attributes->removeElement($attributes);
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

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }
}
