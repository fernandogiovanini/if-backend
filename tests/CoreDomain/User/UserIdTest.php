<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 25/03/16
 * Time: 19:03.
 */
namespace Test\CoreDomain\User;

use CoreDomain\User\UserId;

class UserIdTest extends \PHPUnit_Framework_Testcase
{
    /**
     * @test
     */
    public function should_be_userid_instance()
    {
        $userId = UserId::generate();
        $this->assertInstanceOf('CoreDomain\User\UserId', $userId);
    }

    /**
     * @test
     */
    public function should_be_uuid_instance()
    {
        $userId = UserId::generate();
        $this->assertInstanceOf('Ramsey\Uuid\Uuid', $userId->id());
    }

    /**
     * @test
     */
    public function should_be_equals()
    {
        $userId = UserId::generate();
        $this->assertTrue($userId->equalsTo(
            UserId::create($userId->id()->toString())
        ));
    }

    /**
     * @test
     */
    public function should_be_created_from_string()
    {
        $userId = UserId::create('26d8022e-f45d-4399-a192-b8d7bbb9e206');
        $this->assertEquals('26d8022e-f45d-4399-a192-b8d7bbb9e206', $userId->id()->toString());
    }

    /**
     * @test
     * @expectedException CoreDomain\User\InvalidUserIdException
     */
    public function should_be_invalid_userid()
    {
        UserId::create('invalid_uuid');
    }
}
