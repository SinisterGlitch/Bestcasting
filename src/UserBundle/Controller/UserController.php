<?php

namespace UserBundle\Controller;

use CoreBundle\Controller\BaseController;
use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Controller\Annotations\Post;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use CoreBundle\Service\Mailer\MailContext;
use CoreBundle\Service\Mailer\MailManager;
use CoreBundle\Service\Mailer\Providers\AbstractProvider;
use UserBundle\Entity\User;
use UserBundle\Entity\Repository\UserRepository;
use UserBundle\Security\UserManager;

/**
 * Class UserController
 * @package UserBundle\Controller
 * @NamePrefix("user_user_")
 */
class UserController extends BaseController
{
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
     * @Post("token")
     * @param Request $request
     * @return array
     */
    public function postTokenAction(Request $request)
    {
        $entity = $this->deserialize(new User, $request->getContent(), 'details');

        if ($entity->getToken()) {
            $entity = $this->getUserManager()->loginByToken($entity);
        } else {
            $entity = $this->getUserManager()->loginByCredentials($entity);
        }

        return ['token' => $entity->getToken()];
    }

    /**
     * @param string $handler
     * @param array $params
     * @return MailContext
     */
    private function sendMail($handler, $params = [])
    {
        return $this->getMailer()->send($handler, AbstractProvider::PROVIDER_MANDRILL, $params);
    }

    /**
     * @return UserRepository
     */
    private function getUserRepository()
    {
        return $this->getUserManager()->getRepository();
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
