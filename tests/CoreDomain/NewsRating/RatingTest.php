<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 19/03/16
 * Time: 21:08.
 */
namespace Test\CoreDomain\News;

use CoreDomain\NewsRating\Rating;

class RatingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testCaguei()
    {
        $rating = Rating::caguei();
        $this->assertEquals('0', $rating->value());
    }

    /**
     * @test
     */
    public function testFodaSe()
    {
        $rating = Rating::fodaSe();
        $this->assertEquals('1', $rating->value());
    }

    /**
     * @test
     */
    public function testEnfiaNoCu()
    {
        $rating = Rating::enfiaNoCu();
        $this->assertEquals('2', $rating->value());
    }

    /**
     * @test
     */
    public function testEquals()
    {
        $ratingCaguei = Rating::caguei();
        $this->assertTrue($ratingCaguei->equalsTo(Rating::caguei()));
    }

    /**
     * @test
     */
    public function should_create_caguei_from_id()
    {
        $rating = Rating::fromId(0);
        $this->assertEquals(Rating::caguei(), $rating);
    }

    /**
     * @test
     */
    public function should_create_foda_se_from_id()
    {
        $rating = Rating::fromId(1);
        $this->assertEquals(Rating::fodaSe(), $rating);
    }

    /**
     * @test
     */
    public function should_create_enfia_no_cu_from_id()
    {
        $rating = Rating::fromId(2);
        $this->assertEquals(Rating::enfiaNoCu(), $rating);
    }

    /**
     * @test
     * @expectedException CoreDomain\NewsRating\InvalidRatingIdException
     */
    public function should_throw_invalid_rating_id_exception()
    {
        Rating::fromId(100);
    }
}
