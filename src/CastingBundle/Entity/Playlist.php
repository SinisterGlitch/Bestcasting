<?php

namespace CastingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Table(name="playlist")
 * @ORM\Entity(repositoryClass="CastingBundle\Entity\Repository\PlaylistRepository")
 */
class Playlist
{
    /**
     * @Groups({"list", "details"})
     *
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Groups({"list", "details"})
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @Groups({"list", "details"})
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     * @Groups({"list", "details"})
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @Groups({"details"})
     * @ORM\ManyToOne(targetEntity="Screen", inversedBy="playlists")
     * @ORM\JoinColumn(name="screen_id", referencedColumnName="id")
     **/
    private $screen;

    /**
     * @var Slide[]
     * @Groups({"details"})
     * @ORM\OneToMany(targetEntity="Slide", mappedBy="playlist")
     **/
    private $slides;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->slides = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param boolean $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @return Screen
     */
    public function getScreen()
    {
        return $this->screen;
    }

    /**
     * @param Screen $screen
     * @return $this
     */
    public function setScreen(Screen $screen)
    {
        $this->screen = $screen;

        return $this;
    }

    /**
     * @return Slide[]
     */
    public function getSlides()
    {
        return $this->slides;
    }

    /**
     * @param Slide $slide
     * @return $this
     */
    public function addSlide(Slide $slide)
    {
        $this->slides->add($slide);

        return $this;
    }

    /**
     * @param Slide $slide
     * @return $this
     */
    public function removeSlide(Slide $slide)
    {
        $this->slides->remove($slide);

        return $this;
    }
}
