<?php

namespace EavBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class EavGroup
 * @package EavBundle\Entity
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
     * @var EavAttribute[]
     */
    protected $attributes;

    /**
     * @var EavValue
     */
    protected $value;

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
     * @return EavValue
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param EavValue $value
     * @return $this
     */
    public function setValue(EavValue $value)
    {
        $this->value = $value;

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
