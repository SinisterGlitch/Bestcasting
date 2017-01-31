<?php

namespace EavBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="entity_attribute")
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
     * @var string
     * @ORM\Column(name="type", type="string")
     */
    protected $type;

    /**
     * @var boolean
     * @ORM\Column(name="required", type="boolean")
     */
    protected $required = 0;

    /**
     * @var boolean
     * @ORM\Column(name="searchable", type="boolean")
     */
    protected $searchable = 0;

    /**
     * @var EavGroup[]
     * @ORM\ManyToMany(targetEntity="EavBundle\Entity\EavGroup", inversedBy="attributes", cascade={"persist"})
     * @ORM\JoinTable(name="entity_attribute_group_attribute")
     */
    protected $groups;

    /**
     * EavAttribute constructor.
     */
    public function __construct()
    {
        $this->groups = new ArrayCollection();
    }

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
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return EavGroup[]
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param EavGroup[] $groups
     * @return $this
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;

        return $this;
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
        $this->groups->removeElement($group);

        return $this;
    }

    /**
     * @return boolean
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * @param boolean $isRequired
     * @return $this
     */
    public function setRequired($isRequired)
    {
        $this->required = $isRequired;

        return $this;
    }

    /**
     * @param boolean $searchable
     * @return $this
     */
    public function setSearchable($searchable)
    {
        $this->searchable = $searchable;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isSearchable()
    {
        return $this->searchable;
    }
}
