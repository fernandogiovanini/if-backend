<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 27/03/16
 * Time: 11:36.
 */
namespace Test\Application\Service\Rating;

use Application\Service\Rating\NewsRatingDtoDataTransformer;
use CoreDomain\News\News;
use CoreDomain\News\NewsId;
use CoreDomain\News\Url;
use CoreDomain\News\Rating;
use CoreDomain\User\Email;
use CoreDomain\User\User;
use CoreDomain\User\UserId;

class NewsRatingDtoDataTransformerTest extends \PHPUnit_Framework_TestCase
{
    public function createNews(string $newsId):News
    {
        return new News(
            NewsId::create($newsId),
            new Url('http://www.url.com'),
            'News title');
    }

    public function createUser(string $userId):User
    {
        return User::register(
            UserId::create($userId),
            new Email('email1@email.com')
        );
    }

    /**
     * @test
     */
    public function should_return_news_rating_dto()
    {
        $news = $this->createNews('7102c6a9-4926-43a8-869f-2f198222f1ec');
        $user = $this->createUser('95356bdd-45f6-4ed7-b6de-1c98c90873dc');

        $news->rate(Rating::fodaSe(), $user);

        $dataTransformer = new NewsRatingDtoDataTransformer();
        $dataTransformer->write($news, $user, Rating::fodaSe());

        $newsRatingDto = $dataTransformer->read();

        $this->assertInstanceOf('Application\Service\Rating\NewsRatingDto', $newsRatingDto);
        $this->assertEquals($newsRatingDto->getUserId(), $user->id()->id());
        $this->assertEquals($newsRatingDto->getNewsId(), $news->id()->id());
        $this->assertEquals($newsRatingDto->getRating(), Rating::fodaSe()->value());
    }
}
