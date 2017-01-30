<?php

namespace EavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="eav_entity_attribute")
 * @ORM\Entity(repositoryClass="EavBundle\Entity\Repository\EavAttributeRepository")
 */
class EavAttribute
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
     * @var EavGroup
     * @ORM\ManyToOne(targetEntity="EavBundle\Entity\EavGroup", inversedBy="attributes")
     */
    protected $group;

    /**
     * @var EavValue
     * @ORM\OneToOne(targetEntity="EavBundle\Entity\EavValue", mappedBy="value")
     */
    protected $value;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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

    /**
     * @return EavGroup
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param EavGroup $group
     * @return $this
     */
    public function setGroup(EavGroup $group)
    {
        $this->group = $group;

        return $this;
    }
}
