<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 25/03/16
 * Time: 19:47.
 */
namespace CoreDomainBundle\Persistence\InMemory;

use CoreDomain\News\News;
use CoreDomain\News\NewsId;
use CoreDomain\News\NewsRepository;

class InMemoryNewsRepository implements NewsRepository
{
    protected $news = [];

    public function add(News $news)
    {
        $this->news[] = $news;
    }

    public function findByNewsId(NewsId $newsId)
    {
        return array_reduce($this->news,
            function ($foundedNews, News $news) use ($newsId) {
                if ($news->id()->equalsTo($newsId)) {
                    return $news;
                }

                return $foundedNews;
            },
            null);
    }

    public function count():int
    {
        return count($this->news);
    }

    public function listAll(int $limit, int $offset)
    {
        if (0 > $offset) {
            throw new \InvalidArgumentException('Offset must be greater than 0');
        }

        if (0 >= $limit) {
            throw new \InvalidArgumentException('Offset must be equal or greater than 0');
        }

        $newsArray = [];
        for ($c = $offset;$c < $limit; ++$c) {
            if (!array_key_exists($c, $this->news)) {
                return $newsArray;
            }
            $newsArray[] = $this->news[$c];
        }

        return $newsArray;
    }
}
