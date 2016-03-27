<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 25/03/16
 * Time: 20:52.
 */
namespace Test\CoreDomainBundle\Persistence\InMemory;

use CoreDomain\News\News;
use CoreDomain\News\NewsId;
use CoreDomain\News\Url;
use CoreDomain\NewsRating\Rating;
use CoreDomain\User\Email;
use CoreDomain\User\User;
use CoreDomain\User\UserId;
use CoreDomainBundle\Persistence\InMemory\InMemoryNewsRatingRepository;

class InMemoryNewsRatingRepositoryTest extends \PHPUnit_Framework_TestCase
{
    private $repository;
    private $user1;
    private $user2;
    private $user3;
    private $news1;
    private $news2;
    private $news3;

    public function setUp()
    {
        $this->user1 = User::register(
            UserId::create('0c4cc700-fd81-482e-a19d-732906490c68'),
            new Email('user1@email.com')
        );

        $this->user2 = User::register(
            UserId::create('04981b8c-6ce2-4cb6-86ea-52a82e9e2127'),
            new Email('user2@email.com')
        );

        $this->user3 = User::register(
            UserId::create('07c5e41a-c935-46ff-a496-dd88853e0f1c'),
            new Email('user3@email.com')
        );

        $this->news1 = new News(
            NewsId::create('7665f7f3-da9f-4e2f-9f24-7526f180afa5'),
            new Url('http://www.test.com'),
            'Title news 1');

        $this->news2 = new News(
            NewsId::create('2f9e21af-796f-4b50-a29b-7a4a90c48570'),
            new Url('http://www.test2.com'),
            'Title news 2');

        $this->news3 = new News(
            NewsId::create('bc3fd71d-50aa-46ff-9ab8-6e8cbc538785'),
            new Url('http://www.test3.com'),
            'Title news 3');

        $this->repository = new InMemoryNewsRatingRepository();
        $this->repository->add($this->news1->rate(Rating::caguei(), $this->user1));
        $this->repository->add($this->news1->rate(Rating::caguei(), $this->user2));
        $this->repository->add($this->news2->rate(Rating::fodaSe(), $this->user1));
        $this->repository->add($this->news2->rate(Rating::enfiaNoCu(), $this->user2));
    }

    /**
     * @test
     */
    public function should_find_newsrating()
    {
        $newsRating = $this->repository->findByUserAndNews($this->user1, $this->news1);

        $this->assertInstanceOf('CoreDomain\NewsRating\NewsRating', $newsRating);
    }

    /**
     * @test
     */
    public function should_not_find_newsrating()
    {
        $newsRating = $this->repository->findByUserAndNews($this->user3, $this->news1);

        $this->assertNull($newsRating);
    }
}
