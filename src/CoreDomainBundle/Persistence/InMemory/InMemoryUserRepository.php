<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 25/03/16
 * Time: 19:50.
 */
namespace CoreDomainBundle\Persistence\InMemory;

use CoreDomain\User\User;
use CoreDomain\User\UserId;
use CoreDomain\User\UserRepository;

class InMemoryUserRepository implements UserRepository
{
    private $users = [];

    public function add(User $user)
    {
        $this->users[$user->id()->id()->toString()] = $user;
    }

    public function findByUserId(UserId $userId)
    {
        return array_reduce($this->users,
            function ($foundedUser, $user) use ($userId) {
            if ($user->id()->equalsTo($userId)) {
                return $user;
            }

            return $foundedUser;
        }, null);
    }
}
