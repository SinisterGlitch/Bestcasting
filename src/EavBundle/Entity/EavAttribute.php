<?php

namespace EavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class EavAttribute
 * @package EavBundle\Entity
 * @ORM\MappedSuperclass
 */
abstract class EavAttribute
{
    /**
     * @var string
     * @ORM\Column(name="code", type="string")
     */
    protected $code;

    /**
     * @var EavEntity
     * @ORM\OneToOne(targetEntity="EavBundle\Entity\EavEntity", mappedBy="attributes")
     */
    protected $entity;

    /**
     * @var EavValue
     * @ORM\OneToOne(targetEntity="EavBundle\Entity\EavValue", mappedBy="value")
     */
    protected $value;

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
