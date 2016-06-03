<?php

namespace UserBundle\Security;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use UserBundle\Entity\User;
use UserBundle\Repository\UserRepository;

/**
 * Class DefaultController
 * @package UserBundle\Controller
 */
class UserManager
{
    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * @var UserPasswordEncoder
     */
    private $encoder;

    /**
     * @param EntityManager $manager
     * @param UserPasswordEncoder $encoder
     */
    public function __construct(EntityManager $manager, UserPasswordEncoder $encoder)
    {
        $this->manager = $manager;
        $this->encoder = $encoder;
    }

    /**
     * @param User $user
     * @return User
     */
    public function login(User $user)
    {
        $password = $user->getPassword();
        $user = $this->findUser($user->getUsername());

        if (!$this->validateUser($user, $password)) {
            throw new AuthenticationCredentialsNotFoundException();
        }

        $user->setToken(sha1(uniqid()));
        $em = $this->manager;
        $em->persist($user);
        $em->flush();

        return $user;
    }

    /**
     * @param User $user
     * @return array
     */
    public function register(User $user)
    {
        $user->setPassword($this->encrypt($user, $user->getPassword()));

        $em = $this->manager;
        $em->persist($user);
        $em->flush();

        return $user;
    }

    /**
     * @param User $user
     * @param string $password
     * @return string
     */
    private function encrypt(User $user, $password)
    {
        return $this->encoder->encodePassword($user, $password);
    }

    /**
     * @param string $username
     * @return User
     */
    private function findUser($username)
    {
        return $this->getUserRepository()->findUserByUsername($username);
    }

    /**
     * @param User $user
     * @param string $password
     * @return bool
     */
    private function validateUser(User $user, $password)
    {
        return $user instanceof UserInterface
            && $this->encoder->isPasswordValid($user, $password);
    }

    /**
     * @return UserRepository
     */
    private function getUserRepository()
    {
        return $this->manager->getRepository('UserBundle:User');
    }
}
