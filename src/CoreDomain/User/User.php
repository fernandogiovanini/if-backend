<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 25/03/16
 * Time: 11:06.
 */
namespace CoreDomain\User;

class User
{
    protected $id;
    protected $email;

    private function __construct(UserId $userId, Email $email)
    {
        $this->id = $userId;
        $this->email = $email;
    }

    public static function register(UserId $userId, Email $email):self
    {
        return new self($userId, $email);
    }

    public function id():UserId
    {
        return $this->id;
    }

    public function email():Email
    {
        return $this->email;
    }

    public function equalsTo(User $otherUser):bool
    {
        return $this->id()->equalsTo($otherUser->id());
    }
}
