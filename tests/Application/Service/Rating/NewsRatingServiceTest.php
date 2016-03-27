<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 22/03/16
 * Time: 23:54.
 */
namespace Test\Application\Service\Rating;

use Application\Service\Rating\NewsRatingRequest;
use Application\Service\Rating\NewsRatingService;
use CoreDomain\News\News;
use CoreDomain\News\NewsId;
use CoreDomain\News\Url;
use CoreDomain\NewsRating\Rating;
use CoreDomain\User\Email;
use CoreDomain\User\User;
use CoreDomain\User\UserId;
use CoreDomainBundle\Persistence\InMemory\InMemoryNewsRatingRepository;
use CoreDomainBundle\Persistence\InMemory\InMemoryNewsRepository;
use CoreDomainBundle\Persistence\InMemory\InMemoryUserRepository;

class NewsRatingServiceTest extends \PHPUnit_Framework_TestCase
{
    private $userRepository;
    private $newsRatingRepository;

    public function setUp()
    {
        $this->user = User::register(
            UserId::create('925ad0c5-48a4-4ccb-9f6e-78be3df9de00'),
            new Email('email1@email.com')
        );
        $this->userRepository = new InMemoryUserRepository();
        $this->userRepository->add($this->user);

        $news1 = new News(
            NewsId::create('2f9e21af-796f-4b50-a29b-7a4a90c48570'),
            new Url('http://www.test2.com'),
            'Title news 2');
        $news2 = new News(
            NewsId::create('3367b006-602e-46e3-acc2-9a015dd1d4d0'),
            new Url('http://www.test3.com'),
            'Title news 3');
        $news3 = new News(
            NewsId::create('25e7b6ef-635d-4b73-88a0-3fcd67169e86'),
            new Url('http://www.test3.com'),
            'Title news 4');
        $this->newsRepository = new InMemoryNewsRepository();
        $this->newsRepository->add($news1);
        $this->newsRepository->add($news2);
        $this->newsRepository->add($news3);

        $this->newsRatingRepository = new InMemoryNewsRatingRepository();
        $this->newsRatingRepository->add($news1->rate(Rating::fodaSe(), $this->user));
    }

    public function createNewsRatingService()
    {
        $newsRatingDtoDataTransformerMock =
            $this->getMockBuilder('Application\Service\Rating\NewsRatingDtoDataTransformer')->getMock();

        return new NewsRatingService(
            $newsRatingDtoDataTransformerMock,
            $this->newsRatingRepository,
            $this->userRepository,
            $this->newsRepository);
    }

    /**
     * @test
     */
    public function should_return_news_rating_data_transformer()
    {
        $newsRatingService = $this->createNewsRatingService();
        $newsRatingRequest = new NewsRatingRequest('3367b006-602e-46e3-acc2-9a015dd1d4d0', Rating::CAGUEI, '925ad0c5-48a4-4ccb-9f6e-78be3df9de00');

        $newsRatingResponse = $newsRatingService->execute($newsRatingRequest);

        $this->assertInstanceOf('Application\Service\Rating\NewsRatingDtoDataTransformer', $newsRatingResponse);
    }

    /**
     * @test
     * @expectedException CoreDomain\User\UserNotFoundException
     */
    public function should_throw_user_not_found_exception()
    {
        $newsRatingService = $this->createNewsRatingService();
        $newsRatingRequest = new NewsRatingRequest(
            '2f9e21af-796f-4b50-a29b-7a4a90c48570',
            Rating::CAGUEI,
            'd8700466-d4da-4751-ba59-2db96bc57172');

        $newsRatingService->execute($newsRatingRequest);
    }

    /**
     * @test
     * @expectedException CoreDomain\News\NewsNotFoundException
     */
    public function should_throw_news_not_found_exception()
    {
        $newsRatingService = $this->createNewsRatingService();
        $newsRatingRequest = new NewsRatingRequest(
            'd6863cbe-5155-4ccf-8f39-c2665c44a9b5',
            Rating::CAGUEI,
            '925ad0c5-48a4-4ccb-9f6e-78be3df9de00');

        $newsRatingService->execute($newsRatingRequest);
    }

    /**
     * @test
     * @expectedException CoreDomain\News\NewsNotFoundException
     */
    public function should_throw_user_already_rated_exception()
    {
        $newsRatingService = $this->createNewsRatingService();
        $newsRatingRequest = new NewsRatingRequest(
            'd6863cbe-5155-4ccf-8f39-c2665c44a9b5',
            Rating::CAGUEI,
            '925ad0c5-48a4-4ccb-9f6e-78be3df9de00');

        $newsRatingService->execute($newsRatingRequest);
    }

    /**
     * @test
     */
    public function should_be_rated_as_caguei()
    {
        $newsRatingService = $this->createNewsRatingService();
        $newsRatingRequest = new NewsRatingRequest(
            '25e7b6ef-635d-4b73-88a0-3fcd67169e86',
            Rating::CAGUEI,
            '925ad0c5-48a4-4ccb-9f6e-78be3df9de00');

        $user = User::register(
            UserId::create('925ad0c5-48a4-4ccb-9f6e-78be3df9de00'),
            new Email('email1@email.com')
        );

        $news = new News(
            NewsId::create('25e7b6ef-635d-4b73-88a0-3fcd67169e86'),
            new Url('http://www.url.com'),
            'Title'
        );

        $newsRatingDataTransformer = $newsRatingService->execute($newsRatingRequest);
        $newsRating = $this->newsRatingRepository->findByUserAndNews($user, $news);

        $this->assertEquals(Rating::caguei(), $newsRating->rating());
        $this->assertTrue($user->equalsTo($newsRating->user()));
        $this->assertTrue($news->equalsTo($newsRating->news()));
    }
}
