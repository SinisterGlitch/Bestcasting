<?php

namespace UserBundle\Security;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use UserBundle\Entity\Repository\UserRepository;
use UserBundle\Entity\User;

/**
 * Class UserProvider
 * @package UserBundle\Security
 */
class UserProvider implements UserProviderInterface
{
    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * @param EntityManager $manager
     */
    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param string $token
     * @return string
     */
    public function getUsernameByToken($token)
    {
        $user = $this->getRepository()->findOneBy(['token' => $token]);

        return $user ? $user->getUsername() : '';
    }

    /**
     * @param UserInterface $user
     * @return User
     */
    public function refreshUser(UserInterface $user)
    {
        throw new UnsupportedUserException();
    }

    /**
     * @param string $username
     * @return User
     */
    public function loadUserByUsername($username)
    {
        return $this->getRepository()->findOneBy(['username' => $username]);
    }

    /**
     * @return UserRepository
     */
    private function getRepository()
    {
        return $this->manager->getRepository('UserBundle:User');
    }

    /**
     * @param string $class
     * @return bool
     */
    public function supportsClass($class)
    {
        return $class === get_class(new User());
    }
}