<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\Post;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use CoreBundle\Service\Mailer\MailContext;
use CoreBundle\Service\Mailer\MailManager;
use UserBundle\Entity\User;
use UserBundle\Entity\Repository\UserRepository;
use UserBundle\Security\UserManager;

/**
 * Class AuthController
 * @package ApiBundle\Controller
 * @NamePrefix("api_auth_")
 */
class AuthController extends BaseController
{
    /**
     * @Post("login")
     * @param Request $request
     * @return array
     */
    public function postLoginAction(Request $request)
    {
        $entity = $this->deserialize(new User, $request->getContent(), 'details');

        if ($entity->getToken()) {
            $entity = $this->getUserManager()->loginByToken($entity);
        } else {
            $entity = $this->getUserManager()->loginByCredentials($entity);
        }

        return $this->serialize($entity, 'details');
    }

    /**
     * @Post("register")
     * @param Request $request
     * @return array
     */
    public function postRegisterAction(Request $request)
    {
        $entity = $this->deserialize(new User, $request->getContent(), 'details');
        $entity = $this->getUserManager()->register($entity);

        return $this->serialize($entity, 'details');
    }

    /**
     * @Post("logout")
     * @return array
     */
    public function postLogoutAction()
    {
        $this->getUserManager()->logout($this->getUser());

        return [];
    }

    /**
     * @Post("access")
     * @param Request $request
     * @return array
     */
    public function postAccessAction(Request $request)
    {
        $email = $request->query->get('email', null);

        if ($email === null) {
            throw new BadRequestHttpException('email is required');
        }

        $user = $this->getUserRepository()->findOneBy(['email' => $email]);
        $this->sendMail('access', ['user' => $user]);
    }

    /**
     * @param string $handler
     * @param array $params
     * @return MailContext
     */
    private function sendMail($handler, $params = [])
    {
        return $this->getMailer()->send($handler, $params);
    }

    /**
     * @return UserRepository
     */
    private function getUserRepository()
    {
        return $this->getUserManager()->getRepository();
    }

    /**
     * @return UserManager
     */
    private function getUserManager()
    {
        return $this->get('user.user.manager');
    }

    /**
     * @return MailManager
     */
    private function getMailer()
    {
        return $this->get('core.mailer.manager');
    }
}
