<?php

namespace EavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class EavEntity
 * @package EavBundle\Entity
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
     */
    protected $groups;

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
        $this->grups = new ArrayCollection();
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
}
