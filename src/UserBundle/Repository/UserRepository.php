<?php

namespace UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use UserBundle\Entity\User;

/**
 * Class UserRepository
 * @package UserBundle\Repository
 */
class UserRepository extends EntityRepository
{
    /**
     * @param $username
     * @return User
     */
    public function findUserByUsername($username)
    {
        return $this->findOneBy(['username' => $username]);
    }
}
