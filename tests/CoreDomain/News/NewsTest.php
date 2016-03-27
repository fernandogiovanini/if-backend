<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 20/03/16
 * Time: 11:28.
 */
namespace Test\CoreDomain\News;

use CoreDomain\News\News;
use CoreDomain\News\NewsId;
use CoreDomain\NewsRating\Rating;
use CoreDomain\News\Url;
use CoreDomain\User\Email;
use CoreDomain\User\User;
use CoreDomain\User\UserId;

class NewsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @coversNothing
     */
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
    public function should_return_news_rating()
    {
        $news = $this->generateNews();
        $user = $this->generateUser();

        $newsRating = $news->rate(
            Rating::caguei(),
            $user);

        $this->assertInstanceOf('CoreDomain\NewsRating\NewsRating', $newsRating);
    }

    /**
     * @test
     */
    public function should_be_created_with_news_rating_id_news_user_news_rating()
    {
        $news = $this->generateNews();
        $user = $this->generateUser();

        $newsRating = $news->rate(Rating::fodaSe(), $user);

        $this->assertInstanceOf('CoreDomain\NewsRating\NewsRatingId', $newsRating->id());
        $this->assertTrue($newsRating->user()->equalsTo($user));
        $this->assertTrue($newsRating->rating()->equalsTo(Rating::fodaSe()));
        $this->assertTrue($newsRating->news()->equalsTo($news));
    }

    /**
     * @test
     */
    public function shouldBeCreatedWithNewsIdUrlTitle()
    {
        $news = new News(NewsId::generate(), new Url('http://test.com'), 'News title');

        $this->assertInstanceOf('CoreDomain\News\NewsId', $news->id());
        $this->assertInstanceOf('CoreDomain\News\Url', $news->url());
        $this->assertEquals('News title', $news->title());
    }

    /**
     * @test
     */
    public function should_increment_cagueicount()
    {
        $news = $this->generateNews();

        $news->incrementRatingCount(Rating::caguei());

        $this->assertEquals(1, $news->cagueiCount());
        $this->assertEquals(0, $news->fodaSeCount());
        $this->assertEquals(0, $news->enfiaNoCuCount());
    }

    /**
     * @test
     */
    public function should_increment_fodascount()
    {
        $news = $this->generateNews();

        $news->incrementRatingCount(Rating::fodaSe());

        $this->assertEquals(0, $news->cagueiCount());
        $this->assertEquals(1, $news->fodaSeCount());
        $this->assertEquals(0, $news->enfiaNoCuCount());
    }

    /**
     * @test
     */
    public function should_increment_enfianocucount()
    {
        $news = $this->generateNews();

        $news->incrementRatingCount(Rating::enfiaNoCu());

        $this->assertEquals(0, $news->cagueiCount());
        $this->assertEquals(0, $news->fodaSeCount());
        $this->assertEquals(1, $news->enfiaNoCuCount());
    }

    /**
     * @test
     */
    public function should_be_equals()
    {
        $news = $this->generateNews();

        $this->assertTrue($news->equalsTo($news));
    }

    /**
     * @test
     */
    public function should_not_be_equals()
    {
        $news = $this->generateNews();
        $otherNews = $this->generateNews();

        $this->assertFalse($news->equalsTo($otherNews));
    }
}
