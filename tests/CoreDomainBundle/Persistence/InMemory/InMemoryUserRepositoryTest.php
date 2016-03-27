<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 25/03/16
 * Time: 19:56.
 */
namespace Test\CoreDomainBundle\Persistence\InMemory;

use CoreDomain\User\User;
use CoreDomain\User\Email;
use CoreDomain\User\UserId;
use CoreDomainBundle\Persistence\InMemory\InMemoryUserRepository;

class InMemoryUserRepositoryTest extends \PHPUnit_Framework_TestCase
{
    private $repository;

    public function setUp()
    {
        $this->repository = new InMemoryUserRepository();
        $this->repository->add(User::register(
            UserId::create('925ad0c5-48a4-4ccb-9f6e-78be3df9de00'),
            new Email('email1@email.com'))
        );
        $this->repository->add(User::register(
            UserId::create('517fc1e8-d91d-4a78-b7df-916975462b9e'),
            new Email('email2@email.com'))
        );
        $this->repository->add(User::register(
            UserId::create('d10eb5e2-a294-45bd-95f3-c67e89ca8848'),
            new Email('email3@email.com'))
        );
    }

    /**
     * @test
     */
    public function should_find_user()
    {
        $user = $this->repository->findByUserId(UserId::create('517fc1e8-d91d-4a78-b7df-916975462b9e'));
        $this->assertInstanceOf('CoreDomain\User\User', $user);
    }

    /**
     * @test
     */
    public function should_not_find_user()
    {
        $user = $this->repository->findByUserId(UserId::create('497881ba-1d68-4e1d-b035-339596ec82c1'));
        $this->assertNull($user);
    }
}
