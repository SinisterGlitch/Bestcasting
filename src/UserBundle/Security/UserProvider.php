<?php

namespace UserBundle\Security;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use UserBundle\Entity\User;
use UserBundle\Repository\UserRepository;

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

        return $user instanceof User ? $user->getUsername() : '';
    }

    /**
     * @param string $username
     * @return UserInterface|void
     */
    public function loadUserByUsername($username)
    {
        return $this->getRepository()->findOneBy(['username' => $username]);
    }

    /**
     * @param UserInterface $user
     * @return UserInterface
     */
    public function refreshUser(UserInterface $user)
    {
        return $user;
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
        return 'AppBundle\Entity\User' === $class;
    }
}