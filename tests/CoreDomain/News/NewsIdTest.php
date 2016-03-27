<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 22/03/16
 * Time: 23:21.
 */
namespace Test\CoreDomain\News;

use CoreDomain\News\NewsId;

class NewsIdTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function should_be_newsid_instance()
    {
        $newsId = NewsId::generate();
        $this->assertInstanceOf('CoreDomain\News\NewsId', $newsId);
    }

    /**
     * @test
     */
    public function should_be_uuid_instance()
    {
        $newsId = NewsId::generate();
        $this->assertInstanceOf('Ramsey\Uuid\Uuid', $newsId->id());
    }

    /**
     * @test
     */
    public function should_be_equals()
    {
        $newsId = NewsId::generate();
        $this->assertTrue($newsId->equalsTo(
            NewsId::create($newsId->id()->toString())
        ));
    }

    /**
     * @test
     * @expectedException \CoreDomain\News\InvalidNewsIdException
     */
    public function should_not_create_valid_news_id()
    {
        $newsId = NewsId::create('invalid_uuid');
    }

    /**
     * @test
     */
    public function should_create_valid_news_id()
    {
        $newsId = NewsId::create('57dbf868-e9d9-488e-a43d-bd67cf707932');
        $this->assertInstanceOf('CoreDomain\News\NewsId', $newsId);
    }
}
