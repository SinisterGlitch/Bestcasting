<?php

namespace CastingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="slide")
 * @ORM\Entity(repositoryClass="CastingBundle\Entity\Repository\SlideRepository")
 */
class Slide
{
    /**
     * @var integer
     * @Groups({"list", "details"})
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
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
     * @ORM\Column(name="resolution", type="string", length=255)
     */
    private $resolution;

    /**
     * @var string
     * @Groups({"list", "details"})
     * @ORM\Column(name="data_type", type="string", length=255)
     */
    private $dataType;

    /**
     * @var string
     * @Groups({"list", "details"})
     * @ORM\Column(name="size", type="string", length=255)
     */
    private $size;

    /**
     * @var string
     * @Groups({"list", "details"})
     * @ORM\Column(name="path", type="string", length=245, nullable=false)
     */
    private $path;

    /**
     * @Groups({"details"})
     * @ORM\ManyToMany(targetEntity="Playlist", inversedBy="slides")
     * @ORM\JoinColumn(name="playlist_id", referencedColumnName="id")
     * @ORM\JoinTable(name="playlist_slide")
     **/
    private $playlist;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     * @return $this
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
     * @return Slide
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
     * @param string $resolution
     * @return Slide
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
     * @param string $dataType
     * @return Slide
     */
    public function setDataType($dataType)
    {
        $this->dataType = $dataType;

        return $this;
    }

    /**
     * @return string
     */
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * @param string $size
     * @return Slide
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return Playlist
     */
    public function getPlaylist()
    {
        return $this->playlist;
    }

    /**
     * @param Playlist $playlist
     * @return $this
     */
    public function setPlaylist(Playlist $playlist)
    {
        $this->playlist = $playlist;

        return $this;
    }

    /**
     * @param null $path
     * @return $this
     */
    public function setPath($path = null)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getPath()
    {
        return $this->path;
    }
}
