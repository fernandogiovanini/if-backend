<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 22/03/16
 * Time: 23:01.
 */
namespace Test\CoreDomain\News;

use CoreDomain\News\Url;

class UrlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException CoreDomain\News\InvalidUrlException
     */
    public function should_raise_invalid_url_argument_1()
    {
        $url = new Url('testcom');
    }

    /**
     * @test
     * @expectedException CoreDomain\News\InvalidUrlException
     */
    public function should_raise_invalid_url_argument_2()
    {
        $url = new Url('testcom.com');
    }

    /**
     * @test
     */
    public function should_create_url()
    {
        $url = new Url('http://testcom.com');

        $this->assertEquals('http://testcom.com', $url->url());
    }

    /**
     * @test
     */
    public function should_be_equals()
    {
        $url = new Url('http://www.testcom.com');
        $this->assertTrue($url->equalsTo(new Url('http://www.testcom.com')));
    }

    /**
     * @test
     */
    public function should_not_be_equals()
    {
        $url = new Url('http://www.testcom.com');
        $otherUrl = new Url('http://www.other.com');

        $this->assertFalse($url->equalsTo($otherUrl));
    }
}
