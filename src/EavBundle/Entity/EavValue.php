<?php

namespace EavBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="entity_attribute_value")
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
     * @var string
     *
     * @ORM\Column(name="string_value", type="string", length=255, nullable=true)
     */
    private $stringValue;

    /**
     * @var string
     *
     * @ORM\Column(name="text_value", type="text", nullable=true)
     */
    private $textValue;

    /**
     * @var integer
     *
     * @ORM\Column(name="number_value", type="bigint", nullable=true)
     */
    private $numberValue;

    /**
     * @var float
     *
     * @ORM\Column(name="float_value", type="float", nullable=true)
     */
    private $floatValue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_value", type="datetime", nullable=true)
     */
    private $dateValue;

    /**
     * @var boolean
     *
     * @ORM\Column(name="boolean_value", type="boolean", nullable=true)
     */
    private $booleanValue;

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
        $result = null;
        switch ($this->getAttribute()->getType()) {

            case EavAttribute::TYPE_STRING:
                $result = $this->getStringValue();
                break;

            case EavAttribute::TYPE_TEXT:
                $result = $this->getTextValue();
                break;

            case EavAttribute::TYPE_NUMBER:
                $result = $this->getNumberValue();
                break;

            case EavAttribute::TYPE_FLOAT:
                $result = $this->getFloatValue();
                break;

            case EavAttribute::TYPE_DATE:
                $result = $this->getDateValue();
                break;

            case EavAttribute::TYPE_MULTI_SELECT;
            case EavAttribute::TYPE_SINGLE_SELECT;
                $result = $this->getOptions();
                break;
        }

        return $result;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setValue($value)
    {
        switch ($this->getAttribute()->getType()) {

            case EavAttribute::TYPE_STRING:
                $this->setStringValue($value);
                break;

            case EavAttribute::TYPE_TEXT:
                $this->setTextValue($value);
                break;

            case EavAttribute::TYPE_NUMBER:
                $this->setNumberValue($value);
                break;

            case EavAttribute::TYPE_FLOAT:
                $this->setFloatValue($value);
                break;

            case EavAttribute::TYPE_DATE:
                $this->setDateValue($value);
                break;

            case EavAttribute::TYPE_SINGLE_SELECT;
            case EavAttribute::TYPE_MULTI_SELECT;
                $this->setOptions($value);
                break;
        }

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

    /**
     * @return string
     */
    public function getStringValue()
    {
        return $this->stringValue;
    }

    /**
     * @param string $stringValue
     * @return $this
     */
    public function setStringValue($stringValue)
    {
        $this->stringValue = $stringValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getTextValue()
    {
        return $this->textValue;
    }

    /**
     * @param string $textValue
     * @return $this
     */
    public function setTextValue($textValue)
    {
        $this->textValue = $textValue;

        return $this;
    }

    /**
     * @return integer
     */
    public function getNumberValue()
    {
        return $this->numberValue;
    }

    /**
     * @param integer $numberValue
     * @return $this
     */
    public function setNumberValue($numberValue)
    {
        $this->numberValue = $numberValue;

        return $this;
    }

    /**
     * @return float
     */
    public function getFloatValue()
    {
        return $this->floatValue;
    }

    /**
     * @param float $floatValue
     * @return $this
     */
    public function setFloatValue($floatValue)
    {
        $this->floatValue = $floatValue;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateValue()
    {
        return $this->dateValue;
    }

    /**
     * @param \DateTime $dateValue
     * @return $this
     */
    public function setDateValue(\DateTime $dateValue)
    {
        $this->dateValue = $dateValue;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isBooleanValue()
    {
        return $this->booleanValue;
    }

    /**
     * @param boolean $booleanValue
     * @return $this
     */
    public function setBooleanValue($booleanValue)
    {
        $this->booleanValue = $booleanValue;

        return $this;
    }

}
