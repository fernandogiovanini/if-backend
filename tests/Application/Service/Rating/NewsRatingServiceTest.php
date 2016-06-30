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
use CoreDomain\News\Rating;
use CoreDomain\User\Email;
use CoreDomain\User\User;
use CoreDomain\User\UserId;
use CoreDomainBundle\Persistence\InMemory\InMemoryNewsRepository;
use CoreDomainBundle\Persistence\InMemory\InMemoryUserRepository;

class NewsRatingServiceTest extends \PHPUnit_Framework_TestCase
{
    private $userRepository;
    private $newsRepository;

    public function setUp()
    {
        $this->userRepository = new InMemoryUserRepository();

        $this->user = User::register(
            UserId::create('925ad0c5-48a4-4ccb-9f6e-78be3df9de00'),
            new Email('email1@email.com')
        );

        $this->userRepository->add($this->user);

        $this->newsRepository = new InMemoryNewsRepository();

        $news1 = new News(
            NewsId::create('2f9e21af-796f-4b50-a29b-7a4a90c48570'),
            new Url('http://www.test2.com'),
            'Title news 2');
        $news1->rate(Rating::fodaSe(), $this->user);
        $this->newsRepository->add($news1);

        $news2 = new News(
            NewsId::create('3367b006-602e-46e3-acc2-9a015dd1d4d0'),
            new Url('http://www.test3.com'),
            'Title news 3');
        $this->newsRepository->add($news2);

        $news3 = new News(
            NewsId::create('25e7b6ef-635d-4b73-88a0-3fcd67169e86'),
            new Url('http://www.test3.com'),
            'Title news 4');
        $this->newsRepository->add($news3);
    }

    public function createNewsRatingService()
    {
        $newsRatingDtoDataTransformerMock =
            $this->getMockBuilder('Application\Service\Rating\NewsRatingDtoDataTransformer')->getMock();

        return new NewsRatingService(
            $newsRatingDtoDataTransformerMock,
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
        $news = new News(
            NewsId::create('25e7b6ef-635d-4b73-88a0-3fcd67169e86'),
            new Url('http://www.url.com'),
            'Title'
        );
        $this->newsRepository->add($news);

        $newsRatingService = $this->createNewsRatingService();
        $newsRatingRequest = new NewsRatingRequest(
            $news->id()->id(),
            Rating::CAGUEI,
            $this->user->id()->id());

        $newsRatingService->execute($newsRatingRequest);

        $news = $this->newsRepository->findByNewsId(NewsId::create('25e7b6ef-635d-4b73-88a0-3fcd67169e86'));

        $this->assertTrue($news->wasRatedByUserAs(Rating::caguei(), $this->user));
    }
}
