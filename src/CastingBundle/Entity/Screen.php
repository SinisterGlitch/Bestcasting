<?php

namespace CastingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Table(name="screen")
 * @ORM\Entity(repositoryClass="CastingBundle\Entity\Repository\ScreenRepository")
 */
class Screen
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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     * @Groups({"list", "details"})
     * @ORM\Column(name="resolution", type="string", length=255)
     */
    private $resolution;

    /**
     * @Groups({"details"})
     * @ORM\ManyToOne(targetEntity="Store", inversedBy="screens")
     * @ORM\JoinColumn(name="store_id", referencedColumnName="id")
     **/
    private $store;

    /**
     * @Groups({"details"})
     * @var Playlist[]
     * @ORM\OneToMany(targetEntity="Playlist", mappedBy="screen")
     **/
    private $playlists;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->playlists = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     * @return Screen
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $description
     * @return Screen
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $type
     * @return Screen
     */
    public function setType($type)
    {
        $this->type = $type;

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
     * @param string $resolution
     * @return Screen
     */
    public function setResolution($resolution)
    {
        $this->resolution = $resolution;

        return $this;
    }

    /**
     * @return string
     */
    public function getResolution()
    {
        return $this->resolution;
    }

    /**
     * @return Store
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * @param Store $store
     */
    public function setStore(Store $store)
    {
        $this->store = $store;
    }

    /**
     * @return Playlist[]
     */
    public function getPlaylists()
    {
        return $this->playlists;
    }

    /**
     * @param Playlist $playlist
     */
    public function addPlaylist(Playlist $playlist)
    {
        $this->playlists->add($playlist);
    }

    /**
     * @param Playlist $playlist
     */
    public function removePlaylist(Playlist $playlist)
    {
        $this->playlists->remove($playlist);
    }
}
