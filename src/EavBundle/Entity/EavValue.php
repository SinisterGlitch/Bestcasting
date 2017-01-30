<?php

namespace EavBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class EavValue
 * @package EavBundle\Entity
 */
class EavValue
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="code", type="string")
     */
    private $code;

    /**
     * @var string
     * @ORM\Column(name="value", type="string")
     */
    private $value;

    /**
     * @var EavOption[]
     * @ORM\OneToMany(targetEntity="EavBundle\Entity\EavOption", mappedBy="value")
     **/
    private $options;

    /**
     * EavValue constructor.
     */
    private function __construct()
    {
        $this->options = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
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
     * @return EavOption[]
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param EavOption[] $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @param EavOption $option
     * @return $this
     */
    public function addOption(EavOption $option)
    {
        $this->options[] = $option;

        return $this;
    }

    /**
     * @param EavOption $option
     * @return $this
     */
    public function removeOption(EavOption $option)
    {
        $this->options->removeElement($option);

        return $this;
    }
}
