<?php

namespace EavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Table(name="entity")
 * @ORM\Entity(repositoryClass="EavBundle\Entity\Repository\EavEntityRepository")
 */
class EavEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"details", "list"})
     * @var integer
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="code", type="string")
     * @Groups({"details", "list"})
     */
    protected $code;

    /**
     * @var string
     * @ORM\Column(name="class", type="string")
     * @Groups({"details", "list"})
     */
    protected $class;

    /**
     * @var EavGroup[]
     * @ORM\OneToMany(targetEntity="EavBundle\Entity\EavGroup", mappedBy="attributes", cascade={"all"})
     * @Groups({"details", "list"})
     */
    protected $groups;

    /**
     * @var EavValue[]
     * @ORM\OneToMany(targetEntity="EavBundle\Entity\EavValue", mappedBy="value", cascade={"all"})
     * @Groups({"details", "list"})
     */
    protected $values;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groups = new ArrayCollection();
        $this->values = new ArrayCollection();
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
     * @return EavGroup[]
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param EavGroup $group
     * @return $this
     */
    public function addGroup(EavGroup $group)
    {
        $this->groups[] = $group;

        return $this;
    }

    /**
     * @param EavGroup $group
     * @return $this
     */
    public function removeGroup(EavGroup $group)
    {
        $this->groups[] = $group;

        return $this;
    }

    /**
     * @return EavValue[]
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param EavValue[] $values
     * @return $this
     */
    public function setValues($values)
    {
        $this->values = $values;

        return $this;
    }

    /**
     * @param EavValue $value
     * @return $this
     */
    public function addValue(EavValue $value)
    {
        $this->values[] = $value;

        return $this;
    }

    /**
     * @param EavValue $value
     * @return $this
     */
    public function removeValue(EavValue $value)
    {
        $this->values->removeElement($value);

        return $this;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param string $class
     * @return $this
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }
}
