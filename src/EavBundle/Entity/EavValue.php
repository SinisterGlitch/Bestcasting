<?php

namespace EavBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="eav_entity_attribute_value")
 * @ORM\Entity(repositoryClass="EavBundle\Entity\Repository\EavValueRepository")
 */
class EavValue
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
     * @ORM\Column(name="value", type="string")
     */
    protected $value;

    /**
     * @var EavEntity
     * @ORM\ManyToOne(targetEntity="EavBundle\Entity\EavEntity", inversedBy="values")
     */
    protected $entity;

    /**
     * @var EavAttribute
     * @ORM\OneToOne(targetEntity="EavBundle\Entity\EavAttribute", inversedBy="value")
     */
    protected $attribute;

    /**
     * @var EavOption[]
     * @ORM\OneToMany(targetEntity="EavBundle\Entity\EavOption", mappedBy="value")
     */
    protected $options;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * EavValue constructor.
     */
    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return EavAttribute
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param EavAttribute $attribute
     * @return $this
     */
    public function setAttribute(EavAttribute $attribute)
    {
        $this->attribute = $attribute;

        return $this;
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
     * @return EavOption[]
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param EavOption[] $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @param EavOption $options
     */
    public function addOption(EavOption $options)
    {
        $this->options[] = $options;
    }

    /**
     * @param EavOption $options
     */
    public function removeOption(EavOption $options)
    {
        $this->options->removeElement($options);
    }
}
