<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 25/03/16
 * Time: 11:10.
 */
namespace CoreDomain\User;

class Email
{
    private $email;

    public function __construct(string $email)
    {
        if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }
        $this->email = $email;
    }

    public function email()
    {
        return $this->email;
    }

    public function equalsTo(Email $email)
    {
        return $this->email() === $email->email();
    }
}
