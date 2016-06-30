<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 26/03/16
 * Time: 22:37.
 */
namespace Test\CoreDomain\News;

use CoreDomain\News\News;
use CoreDomain\News\NewsId;
use CoreDomain\News\Url;
use CoreDomain\News\NewsRating;
use CoreDomain\News\Rating;
use CoreDomain\User\Email;
use CoreDomain\User\User;
use CoreDomain\User\UserId;

class NewsRatingTest extends \PHPUnit_Framework_TestCase
{
    public function generateUser():User
    {
        return User::register(
            UserId::generate(),
            new Email('email2@email.com'));
    }

    /**
     * @test
     */
    public function should_be_rated_by_user()
    {
        $user = $this->generateUser();

        $newsRating = new NewsRating(Rating::fodaSe(), $user);

        $this->assertTrue($newsRating->wasRatedBy($user));
    }

    /**
     * @test
     */
    public function should_not_be_rated_by_user()
    {
        $user = $this->generateUser();
        $otherUser = $this->generateUser();

        $newsRating = new NewsRating(Rating::fodaSe(), $user);

        $this->assertFalse($newsRating->wasRatedBy($otherUser));
    }


    /**
     * @test
     */
    public function should_be_the_rated_as_foda_se()
    {
        $user = $this->generateUser();

        $newsRating = new NewsRating(Rating::fodaSe(), $user);

        $this->assertTrue($newsRating->wasRatedAs(Rating::fodaSe()));
    }

    /**
     * @test
     */
    public function should_not_be_the_rated_as_foda_se()
    {
        $user = $this->generateUser();

        $newsRating = new NewsRating(Rating::caguei(), $user);

        $this->assertFalse($newsRating->wasRatedAs(Rating::fodaSe()));
    }
}
