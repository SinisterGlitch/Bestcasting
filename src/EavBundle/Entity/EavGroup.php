<?php

namespace EavBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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
     * @var integer
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="code", type="string")
     */
    protected $code;

    /**
     * @var EavEntity
     * @ORM\OneToOne(targetEntity="EavBundle\Entity\EavEntity", inversedBy="groups", cascade={"persist"})
     */
    protected $entity;

    /**
     * @var EavAttribute[]
     * @ORM\ManyToMany(targetEntity="EavBundle\Entity\EavAttribute", mappedBy="group", cascade={"persist"})
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