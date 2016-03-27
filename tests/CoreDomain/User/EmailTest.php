<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 25/03/16
 * Time: 11:35.
 */
namespace Test\CoreDomain\User;

use CoreDomain\User\Email;

class EmailTest extends \PHPUnit_Framework_Testcase
{
    /**
     * @test
     * @expectedException CoreDomain\User\InvalidEmailException
     */
    public function should_be_invalid_email_1()
    {
        $email = new Email('invalid_email');
    }

    /**
     * @test
     * @expectedException CoreDomain\User\InvalidEmailException
     */
    public function should_be_invalid_email_2()
    {
        $email = new Email('invalid@email');
    }

    /**
     * @test
     */
    public function should_be_valid_email()
    {
        $email = new Email('valid@email.com');
        $this->assertEquals('valid@email.com', $email->email());
    }

    /**
     * @test
     */
    public function should_be_equals()
    {
        $email = new Email('valid@email.com');
        $this->assertTrue($email->equalsTo(new Email('valid@email.com')));
    }

    /**
     * @test
     */
    public function should_not_be_equals()
    {
        $email = new Email('valid@email.com');
        $this->assertFalse($email->equalsTo(new Email('other_valid@email.com')));
    }
}
