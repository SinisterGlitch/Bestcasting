<?php

namespace EavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\InheritanceType;

/**
 * @ORM\Entity(repositoryClass="EavBundle\Entity\Repository\EavEntityRepository")
 *
 * @InheritanceType("SINGLE_TABLE")
 * @DiscriminatorColumn(name="discr", type="string")
 */
class EavEntity
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
     * @var EavGroup[]
     * @ORM\OneToMany(targetEntity="EavBundle\Entity\EavGroup", mappedBy="attributes", cascade={"persist"})
     */
    protected $groups;

    /**
     * @var EavValue[]
     * @ORM\OneToMany(targetEntity="EavBundle\Entity\EavValue", mappedBy="value", cascade={"persist"})
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
}
