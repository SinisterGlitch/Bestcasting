<?php

namespace UserBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use UserBundle\Entity\User;

/**
 * Class UserRepository
 * @package UserBundle\Entity\Repository
 */
class UserRepository extends EntityRepository
{
    /**
     * @param string $username
     * @return User
     */
    public function findUserByUsername($username)
    {
        return $this->findOneByParams(['username' => $username]);
    }

    /**
     * @param string $token
     * @return User
     */
    public function findUserByToken($token)
    {
        return $this->findOneByParams(['token' => $token]);
    }

    /**
     * @param string $email
     * @return User
     */
    public function findUserByEmail($email)
    {
        return $this->findOneByParams(['email' => $email]);
    }

    /**
     * @param string $code
     * @return User
     */
    public function findUserByCode($code)
    {
        return $this->findOneByParams(['code' => $code]);
    }

    /**
     * @param array $params
     * @return null|User
     */
    public function findOneByParams(array $params)
    {
        return $this->findOneBy($params);
    }
}