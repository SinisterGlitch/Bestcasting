<?php

namespace UserBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserRepository
 * @package UserBundle\Entity\Repository
 */
class UserRepository extends EntityRepository
{
    /**
     * @param string $username
     * @return UserInterface
     */
    public function findUserByUsername($username)
    {
        return $this->findOneByParams(['user_name' => $username]);
    }

    /**
     * @param string $token
     * @return UserInterface
     */
    public function findUserByToken($token)
    {
        return $this->findOneByParams(['token' => $token]);
    }

    /**
     * @param string $email
     * @return UserInterface
     */
    public function findUserByEmail($email)
    {
        return $this->findOneByParams(['email' => $email]);
    }

    /**
     * @param string $code
     * @return UserInterface
     */
    public function findUserByCode($code)
    {
        return $this->findOneByParams(['code' => $code]);
    }

    /**
     * @param array $params
     * @return UserInterface
     */
    public function findOneByParams(array $params)
    {
        return $this->findOneBy($params);
    }
}