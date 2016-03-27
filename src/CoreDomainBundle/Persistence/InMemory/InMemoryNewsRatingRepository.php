<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 25/03/16
 * Time: 19:47.
 */
namespace CoreDomainBundle\Persistence\InMemory;

use CoreDomain\News\News;
use CoreDomain\NewsRating\NewsRating;
use CoreDomain\NewsRating\NewsRatingRepository;
use CoreDomain\User\User;

class InMemoryNewsRatingRepository implements NewsRatingRepository
{
    protected $newsRatings = [];

    public function add(NewsRating $newsRating)
    {
        $this->newsRatings[] = $newsRating;
    }

    public function findByUserAndNews(User $user, News $news)
    {
        return array_reduce($this->newsRatings,
            function ($foundedNewsRating, NewsRating $newsRating) use ($user, $news) {
                if ($newsRating->wasNewsRatedBy($news, $user)) {
                    $foundedNewsRating = $newsRating;
                }

                return $foundedNewsRating;
            },
            null);
    }
}
