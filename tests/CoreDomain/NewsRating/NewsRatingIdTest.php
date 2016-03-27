<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 27/03/16
 * Time: 09:11.
 */
namespace Test\CoreDomain\NewsRating;

use CoreDomain\NewsRating\NewsRatingId;

class NewsRatingIdTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function should_be_newsratingid_instance()
    {
        $newsRatingId = NewsRatingId::generate();

        $this->assertInstanceOf('CoreDomain\NewsRating\NewsRatingId', $newsRatingId);
    }

    /**
     * @test
     */
    public function should_be_uuid_instance()
    {
        $newsRatingId = NewsRatingId::generate();

        $this->assertInstanceOf('Ramsey\Uuid\Uuid', $newsRatingId->id());
    }

    /**
     * @test
     */
    public function should_be_created_from_valid_uuid_string()
    {
        $newsRatingId = NewsRatingId::create('8ae3ac60-c386-4837-b3cb-2a853201fd0d');

        $this->assertInstanceOf('CoreDomain\NewsRating\NewsRatingId', $newsRatingId);
    }

    /**
     * @test
     * @expectedException CoreDomain\NewsRating\InvalidNewsRatingIdException
     */
    public function should_not_be_created_from_invalid_uuid_string()
    {
        $newsRatingId = NewsRatingId::create('invalid_uuid');
    }

    /**
     * @test
     */
    public function should_be_equals()
    {
        $newsRatingId = NewsRatingId::generate();

        $this->assertTrue(
            $newsRatingId->equalsTo(
                NewsRatingId::create($newsRatingId->id()->toString())
            ));
    }

    /**
     * @test
     */
    public function should_not_be_equals()
    {
        $newsRatingId = NewsRatingId::generate();

        $this->assertFalse(
            $newsRatingId->equalsTo(
                NewsRatingId::create('c3fdb383-5319-409e-8bb7-0de6873be2e8')
            ));
    }
}
