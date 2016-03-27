<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 25/03/16
 * Time: 11:07.
 */
namespace CoreDomain\User;

interface UserRepository
{
    public function add(User $user);
    public function findByUserId(UserId $userId);
}
