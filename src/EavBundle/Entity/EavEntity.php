<?php

namespace EavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class EavEntity
 * @package EavBundle\Entity
 * @ORM\MappedSuperclass
 */
abstract class EavEntity
{
    /**
     * @var string
     * @ORM\Column(name="code", type="string")
     */
    protected $code;

    /**
     * @var EavAttribute[]
     * @ORM\OneToMany(targetEntity="EavBundle\Entity\EavAttribute", mappedBy="entity")
     */
    protected $attributes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attributes = new ArrayCollection();
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

    /**
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
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
}
