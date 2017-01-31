<?php

namespace EavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="entity_attribute_value_option")
 * @ORM\Entity(repositoryClass="EavBundle\Entity\Repository\EavOptionRepository")
 */
class EavOption
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
     * @var EavValue
     * @ORM\ManyToOne(targetEntity="EavBundle\Entity\EavValue", inversedBy="value")
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
     * @return EavValue
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param EavValue $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
