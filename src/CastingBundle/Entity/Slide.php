<?php

namespace CastingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
     * @var null|UploadedFile
     * @Groups({"list", "details"})
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**
     * @var string
     * @Groups({"list", "details"})
     * @ORM\Column(name="path", type="string", length=245, nullable=false)
     */
    private $path;

    /**
     * @Groups({"details"})
     * @ORM\ManyToOne(targetEntity="Playlist", inversedBy="slides")
     * @ORM\JoinColumn(name="playlist_id", referencedColumnName="id")
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
     * @param UploadedFile $file
     * @return $this
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @return null|string|UploadedFile
     */
    public function getFile()
    {
        if (!$this->file instanceof UploadedFile && $this->getPath()) {
            return new File($this->getPublicPath());
        }

        return $this->file;
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

    /**
     * @return string
     */
    public function getRealPath()
    {
        return realpath($this->getUploadRootDir() . '/' . $this->getPath());
    }

    /**
     * @return string
     */
    public function getPublicPath()
    {
        return $this->getUploadDir() . '/' . $this->getPath();
    }

    /**
     * File upload
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        $filename = md5(uniqid(rand(), true)) . '.' . $this->getFile()->getClientOriginalExtension();
        $this->getFile()->move($this->getUploadRootDir(), $filename);
        $this->path = $filename;
        $this->file = null;
    }

    /**
     * @return string
     */
    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../../../web/' . $this->getUploadDir();
    }

    /**
     * @return string
     */
    protected function getUploadDir()
    {
        return 'uploads/slides';
    }
}