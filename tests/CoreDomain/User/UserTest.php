<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 25/03/16
 * Time: 11:12.
 */
namespace Test\CoreDomain;

use CoreDomain\User\User;
use CoreDomain\User\Email;
use CoreDomain\User\UserId;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function generateUser():User
    {
        return User::register(
            UserId::generate(),
            new Email('email@email.com'));
    }

    /**
     * @test
     */
    public function should_create_user_with_email()
    {
        $user = User::register(
            UserId::generate(),
            new Email('email@email.com'));

        $this->assertInstanceOf('CoreDomain\User\Email', $user->email());
        $this->assertEquals('email@email.com', $user->email()->email());
        $this->assertInstanceOf('CoreDomain\User\UserId', $user->id());
    }

    /**
     * @test
     */
    public function should_be_equals()
    {
        $user = $this->generateUser();

        $this->assertTrue($user->equalsTo($user));
    }

    /**
     * @test
     */
    public function should_not_be_equals()
    {
        $user = $this->generateUser();
        $otherUser = $this->generateUser();

        $this->assertFalse($user->equalsTo($otherUser));
    }
}
