<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 27/03/16
 * Time: 17:19.
 */
namespace Test\Application\Service\Rating;

use CoreDomain\News\News;
use CoreDomain\News\NewsId;
use CoreDomain\News\Url;
use CoreDomain\NewsRating\OneNewsRatingPerUserSpecification;
use CoreDomain\NewsRating\Rating;
use CoreDomain\User\Email;
use CoreDomain\User\User;
use CoreDomain\User\UserId;

class OneNewsRatingPerUserSpecificationTest extends \PHPUnit_Framework_TestCase
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

    public function createNewsRating($userId, $newsId, $rating)
    {
        $news = $this->createNews($newsId);
        $user = $this->createUser($userId);

        return $news->rate($rating, $user);
    }

    /**
     * @test
     */
    public function should_allow_one_rating_per_user()
    {
        $newsRating = $this->createNewsRating(
            '97a3d8b2-0384-43e3-ab90-80c47e1063c6',
            'eb229a71-b78a-434e-b0f3-7488c95f45ac',
            Rating::caguei());
        $newsRatingRepositoryMock =
            $this->getMockBuilder('CoreDomain\NewsRating\NewsRatingRepository')->getMock();
        $newsRatingRepositoryMock->method('findByUserAndNews')->will($this->returnValue(null));

        $oneNewsRatingPerUserSpecification = new OneNewsRatingPerUserSpecification($newsRatingRepositoryMock);

        $this->assertTrue($oneNewsRatingPerUserSpecification->isSatisfiedBy($newsRating));
    }

    /**
     * @test
     */
    public function should_not_allow_two_ratings_per_user()
    {
        $newsRating = $this->createNewsRating(
            '97a3d8b2-0384-43e3-ab90-80c47e1063c6',
            'eb229a71-b78a-434e-b0f3-7488c95f45ac',
            Rating::caguei());
        $newsRatingRepositoryMock =
            $this->getMockBuilder('CoreDomain\NewsRating\NewsRatingRepository')->getMock();
        $newsRatingRepositoryMock->method('findByUserAndNews')->will($this->returnValue([1]));

        $oneNewsRatingPerUserSpecification = new OneNewsRatingPerUserSpecification($newsRatingRepositoryMock);

        $this->assertFalse($oneNewsRatingPerUserSpecification->isSatisfiedBy($newsRating));
    }
}
