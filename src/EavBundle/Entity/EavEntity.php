<?php

namespace EavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Table(name="eav_entity")
 * @ORM\Entity(repositoryClass="EavBundle\Entity\Repository\EavEntityRepository")
 */
class EavEntity
{
    /**
     * @var integer
     * @Groups({"list", "details"})
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Groups({"list", "details"})
     * @ORM\Column(name="code", type="string")
     */
    private $code;

    /**
     * @var EavAttribute[]
     * @ORM\OneToMany(targetEntity="EavBundle\Entity\EavAttribute", mappedBy="entity")
     **/
    private $attributes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attributes = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
