<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 26/03/16
 * Time: 22:37.
 */
namespace Test\CoreDomain\NewsRating;

use CoreDomain\News\News;
use CoreDomain\News\NewsId;
use CoreDomain\News\Url;
use CoreDomain\NewsRating\Rating;
use CoreDomain\User\Email;
use CoreDomain\User\User;
use CoreDomain\User\UserId;

class NewsRatingTest extends \PHPUnit_Framework_TestCase
{
    public function generateNews():News
    {
        return new News(NewsId::generate(), new Url('http://test.com'), 'News title');
    }

    public function generateUser():User
    {
        return User::register(
            UserId::generate(),
            new Email('email2@email.com'));
    }

    /**
     * @test
     */
    public function should_be_rated_by()
    {
        $news = $this->generateNews();
        $user = $this->generateUser();

        $newsRating = $news->rate(Rating::fodaSe(), $user);

        $this->assertTrue($newsRating->wasNewsRatedBy($news, $user));
    }

    /**
     * @test
     */
    public function should_not_be_rated_by_user()
    {
        $news = $this->generateNews();
        $ratingUser = $this->generateUser();
        $notRatingUser = $this->generateUser();

        $newsRating = $news->rate(Rating::fodaSe(), $ratingUser);

        $this->assertFalse($newsRating->wasNewsRatedBy($news, $notRatingUser));
    }

    /**
     * @test
     */
    public function should_not_be_the_news_rated_by_user()
    {
        $ratedNews = $this->generateNews();
        $notRatedNews = $this->generateNews();
        $ratingUser = $this->generateUser();

        $newsRating = $ratedNews->rate(Rating::fodaSe(), $ratingUser);

        $this->assertFalse($newsRating->wasNewsRatedBy($notRatedNews, $ratingUser));
    }
}
