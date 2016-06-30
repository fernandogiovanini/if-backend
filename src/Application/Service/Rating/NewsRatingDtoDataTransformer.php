<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 27/03/16
 * Time: 11:45.
 */
namespace Application\Service\Rating;

use CoreDomain\News\News;
use CoreDomain\News\Rating;
use CoreDomain\User\User;

class NewsRatingDtoDataTransformer implements NewsRatingDataTransformer
{
    private $newsRating;

    public function write(News $news, User $user, Rating $rating)
    {
        $this->newsRating = new NewsRatingDto();
        $this->newsRating->setUserId($user->id()->id());
        $this->newsRating->setNewsId($news->id()->id());
        $this->newsRating->setRating($rating->value());
    }

    public function read()
    {
        return $this->newsRating;
    }
}
