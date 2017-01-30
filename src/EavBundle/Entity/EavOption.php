<?php

namespace EavBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="eav_etity_attribute_value_option")
 * @ORM\Entity(repositoryClass="EavBundle\Entity\Repository\EavOptionRepository")
 * @ORM\MappedSuperclass()
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
     * @var EavAttribute[]
     * @ORM\OneToMany(targetEntity="CatalogBundle\Entity\Attribute", mappedBy="value")
     */
    protected $attribute;

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
}
