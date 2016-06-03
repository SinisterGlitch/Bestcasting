<?php

namespace UserBundle\Controller;

use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use UserBundle\Entity\User;
use UserBundle\Security\UserManager;

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
        $user = $this->getUserManager()->login($user);

       return ['token' => $user->getToken()];
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
        $this->getUserManager()->register($user);

        return ['user' => $user];
    }

    /**
     * @return UserManager
     */
    private function getUserManager()
    {
        return $this->get('core_user_manager');
    }
}
