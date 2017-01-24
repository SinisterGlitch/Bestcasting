<?php

namespace UserBundle\Security;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use CoreBundle\Service\Mailer\MailManager;
use UserBundle\Entity\Repository\UserRepository;
use UserBundle\Entity\User;

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
     * @var MailManager
     */
    private $mailManager;

    /**
     * @param EntityManager $manager
     * @param UserPasswordEncoder $encoder
     * @param MailManager $mailManager
     */
    public function __construct(EntityManager $manager, UserPasswordEncoder $encoder, MailManager $mailManager)
    {
        $this->manager = $manager;
        $this->encoder = $encoder;
        $this->mailManager = $mailManager;
    }

    /**
     * @param User $user
     * @param bool $validate
     * @return User
     */
    public function loginByCredentials(User $user, $validate = true)
    {
        $password = $user->getPassword();
        $user = $this->findUser(['username' => $user->getUsername()]);

        if ($validate && (!$user || !$this->validateUser($user, $password))) {
            throw new BadRequestHttpException('Given credentials are invalid');
        }

        if (!$user->getEnabled()) {
            throw new BadRequestHttpException('User is not enabled');
        }

        return $this->saveUser($user);
    }

    /**
     * @param User $user
     * @return User
     */
    public function loginByToken(User $user)
    {
        $user = $this->findUser(['token' => $user->getToken()]);

        if (!$user->getEnabled()) {
            throw new BadRequestHttpException('User is not enabled');
        }

        return $this->saveUser($user);
    }

    /**
     * @param User $user
     * @return User
     */
    public function logout(User $user)
    {
        $user = $this->findUser(['id' => $user->getId()]);

        return $this->saveUser($user);
    }

    /**
     * @param User $user
     * @return User
     */
    public function updatePassword(User $user)
    {
        $user->setPassword($this->encrypt($user, $user->getPassword()));

        return $this->saveUser($user, false);
    }

    /**
     * @param User $user
     * @return User
     */
    public function register(User $user)
    {
        $user->setSalt(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36));
        $user->setPassword($this->encrypt($user, $user->getPassword()));

        if ($this->findUser(['username' => $user->getUsername()]) instanceof User) {
            throw new UnsupportedUserException('given username already exists');
        }

        return $this->saveUser($user);
    }

    /**
     * @param User $user
     * @param bool $resetToken
     * @return User
     */
    public function saveUser(User $user, $resetToken = true)
    {
        if ($resetToken) {
            $token = $this->createToken();
            $user->setToken($token);
        }

        $this->manager->persist($user);
        $this->manager->flush();

        return $user;
    }

    /**
     * @return UserRepository
     */
    public function getRepository()
    {
        return $this->manager->getRepository('UserBundle:User');
    }

    /**
     * @param string $property
     * @param string $value
     */
    public function resetPassword($property, $value)
    {
        $user = null;
        $user = $this->getRepository()->findOneByParams([$property => $value]);

        if (!$user) {
            throw new BadRequestHttpException();
        }

        $this->mailManager->send('access', 'mandrill', ['user' => $user]);
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
     * @param array $params
     * @return User
     */
    private function findUser($params)
    {
        return $this->getRepository()->findOneByParams($params);
    }

    /**
     * @param User $user
     * @param string $password
     * @return bool
     */
    private function validateUser(User $user, $password)
    {
        return $this->encoder->isPasswordValid($user, $password);
    }

    /**
     * @return string
     */
    private function createToken()
    {
        return base_convert(sha1(uniqid(mt_rand(), true)), 16, 20);
    }
}
