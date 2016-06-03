<?php

namespace UserBundle\Controller;

use Doctrine\ORM\EntityManager;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\User\UserInterface;
use UserBundle\Entity\User;
use UserBundle\Repository\UserRepository;

/**
 * Class DefaultController
 * @package UserBundle\Controller
 */
class AuthController extends FOSRestController
{
    /**
     * @Post("login")
     * @ParamConverter("user", converter="fos_rest.request_body")
     *
     * @param User $user
     * @return array
     */
    public function loginAction(User $user)
    {
        $password = $user->getPassword();
        $user = $this->findUser($user->getUsername());

        if (!$user instanceof UserInterface
            || !$this->getEncoder()->isPasswordValid($user, $password)
        ) {
            throw $this->createAccessDeniedException();
        }

        $user->setToken(sha1(uniqid()));

        $em = $this->getManager();
        $em->persist($user);
        $em->flush();

        return $user->getToken();
    }

    /**
     * @Post("register")
     * @ParamConverter("user", converter="fos_rest.request_body")
     *
     * @param User $user
     * @return array
     */
    public function registerAction(User $user)
    {
        $user->setPassword($this->encrypt($user, $user->getPassword()));

        $em = $this->getManager();
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
        return $this->getEncoder()->encodePassword($user, $password);
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
     * @return UserRepository
     */
    private function getUserRepository()
    {
        return $this->getManager()->getRepository('UserBundle:User');
    }

    /**
     * @return EntityManager
     */
    private function getManager()
    {
        return $this->getDoctrine()->getManager();
    }

    /**
     * @return UserPasswordEncoder
     */
    private function getEncoder()
    {
        return $this->get('security.password_encoder');
    }
}
