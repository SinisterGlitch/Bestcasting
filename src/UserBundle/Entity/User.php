<?php

namespace UserBundle\Entity;

use CatalogBundle\Entity\Playlist;
use CatalogBundle\Entity\Screen;
use CatalogBundle\Entity\Slide;
use CatalogBundle\Entity\Store;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Entity\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @Groups({"list", "details"})
     * @Type("integer")
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Groups({"list", "details"})
     * @Type("string")
     *
     * @var string
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    protected $username;

    /**
     * @Groups({"list", "details"})
     * @Type("string")
     *
     * @var string
     * @ORM\Column(name="first_name", type="string", length=255, nullable=true)
     */
    protected $first_name;

    /**
     * @Groups({"list", "details"})
     * @Type("string")
     *
     * @var string
     * @ORM\Column(name="last_name", type="string", length=255, nullable=true)
     */
    protected $last_name;

    /**
     * @Groups({"details"})
     * @Type("string")
     *
     * @var string
     */
    protected $plainPassword;

    /**
     * @Groups({"details"})
     * @Type("string")
     *
     * @var string
     * @ORM\Column(name="password", type="string", length=255)
     */
    protected $password;

    /**
     * @var string
     * @ORM\Column(name="salt", type="string", length=255, nullable=true)
     */
    protected $salt;

    /**
     * @Groups({"details"})
     * @Type("string")
     *
     * @var string
     * @ORM\Column(name="token", type="string", length=255)
     */
    protected $token;

    /**
     * @Groups({"list", "details"})
     * @Type("boolean")
     *
     * @var boolean
     * @ORM\Column(name="enabled", type="boolean")
     */
    protected $enabled = false;

    /**
     * @Groups({"list", "details"})
     * @Type("string")
     *
     * @var string
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    protected $email;

    /**
     * @var Store[]
     * @ORM\OneToMany(targetEntity="CatalogBundle\Entity\Store", mappedBy="user")
     **/
    private $stores;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->stores = new ArrayCollection();
    }

    /**
     * @param string $firstname
     * @return $this
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $lastName
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return bool
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     * @return $this
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return bool
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param string $salt
     * @return $this
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return bool
     */
    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    /**
     * @return string
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     * @return $this
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Store[]
     */
    public function getStores()
    {
        return $this->stores;
    }

    /**
     * @param Store $store
     * @return $this
     */
    public function addStore(Store $store)
    {
        $this->stores->add($store);

        return $this;
    }

    /**
     * @param Store $store
     * @return $this
     */
    public function removeStore(Store $store)
    {
        $this->stores->remove($store);

        return $this;
    }

    /**
     * @return Slide[]
     */
    public function getSlides()
    {
        $result = [];
        foreach ($this->getPlaylists() as $playlist) {
            foreach ($playlist->getSlides() as $slide) {
                $result[] = $slide;
            }
        }

        return $result;
    }

    /**
     * @return Screen[]
     */
    public function getScreens()
    {
        $result = [];
        foreach ($this->getStores() as $store) {
            foreach ($store->getScreens() as $screen) {
                $result[] = $screen;
            }
        }

        return $result;
    }

    /**
     * @return Playlist[]
     */
    public function getPlaylists()
    {
        $result = [];
        foreach ($this->getScreens() as $screen) {
            foreach ($screen->getPlaylists() as $playlist) {
                $result[] = $playlist;
            }
        }

        return $result;
    }
}
