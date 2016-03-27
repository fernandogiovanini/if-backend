<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 25/03/16
 * Time: 20:52.
 */
namespace Test\CoreDomainBundle\Persistence\InMemory;

use CoreDomain\News\News;
use CoreDomain\News\NewsId;
use CoreDomain\News\Url;
use CoreDomainBundle\Persistence\InMemory\InMemoryNewsRepository;

class InMemoryNewsRepositoryTest extends \PHPUnit_Framework_TestCase
{
    private $repository;

    public function setUp()
    {
        $news1 = new News(
            NewsId::create('7665f7f3-da9f-4e2f-9f24-7526f180afa5'),
            new Url('http://www.test1.com'),
            'Title news 1');

        $news2 = new News(
            NewsId::create('2f9e21af-796f-4b50-a29b-7a4a90c48570'),
            new Url('http://www.test2.com'),
            'Title news 2');

        $news3 = new News(
            NewsId::create('bc3fd71d-50aa-46ff-9ab8-6e8cbc538785'),
            new Url('http://www.test3.com'),
            'Title news 3');

        $this->repository = new InMemoryNewsRepository();
        $this->repository->add($news1);
        $this->repository->add($news2);
        $this->repository->add($news3);
    }

    /**
     * @test
     */
    public function should_find_news()
    {
        $news = $this->repository->findByNewsId(NewsId::create('2f9e21af-796f-4b50-a29b-7a4a90c48570'));

        $this->assertInstanceOf('CoreDomain\News\News', $news);
    }

    /**
     * @test
     */
    public function should_not_find_news()
    {
        $news = $this->repository->findByNewsId(NewsId::create('a34d1b0d-c1ec-43ba-b851-4761847968ab'));

        $this->assertNull($news);
    }
}
