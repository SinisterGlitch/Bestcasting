<?php

namespace EavBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;

/**
 * @ORM\Table(name="entity_attribute")
 * @ORM\Entity(repositoryClass="EavBundle\Entity\Repository\EavAttributeRepository")
 */
class EavAttribute
{
    const TYPE_SINGLE_SELECT = 'single_select';
    const TYPE_MULTI_SELECT = 'multi_select';
    const TYPE_NUMBER = 'number';
    const TYPE_STRING = 'string';
    const TYPE_BOOLEAN = 'bool';
    const TYPE_FLOAT = 'float';
    const TYPE_TEXT = 'text';
    const TYPE_DATE = 'date';

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"details", "list"})
     * @Type("integer")
     * @var integer
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="code", type="string")
     * @Groups({"details", "list"})
     * @Type("string")
     */
    protected $code;

    /**
     * @var string
     * @ORM\Column(name="type", type="string")
     * @Groups({"details", "list"})
     * @Type("string")
     */
    protected $type;

    /**
     * @var boolean
     * @ORM\Column(name="required", type="boolean")
     * @Groups({"details", "list"})
     * @Type("boolean")
     */
    protected $required = 0;

    /**
     * @var boolean
     * @ORM\Column(name="searchable", type="boolean")
     * @Groups({"details", "list"})
     * @Type("boolean")
     */
    protected $searchable = 0;

    /**
     * @var EavGroup[]
     * @ORM\JoinTable(name="entity_attribute_group_attribute")
     * @ORM\ManyToMany(targetEntity="EavBundle\Entity\EavGroup", inversedBy="attributes", cascade={"persist"})
     * @Type("ArrayCollection<EavBundle\Entity\EavGroup>")
     * @Groups({"details", "list"})
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
