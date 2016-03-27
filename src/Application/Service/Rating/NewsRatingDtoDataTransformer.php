<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 27/03/16
 * Time: 11:45.
 */
namespace Application\Service\Rating;

use CoreDomain\NewsRating\NewsRating;

class NewsRatingDtoDataTransformer implements NewsRatingDataTransformer
{
    private $newsRating;

    public function write(NewsRating $newsRating)
    {
        $this->newsRating = new NewsRatingDto();
        $this->newsRating->setNewsRatingId($newsRating->id()->id()->toString());
        $this->newsRating->setUserId($newsRating->user()->id()->id()->toString());
        $this->newsRating->setNewsId($newsRating->news()->id()->id()->toString());
        $this->newsRating->setRating($newsRating->rating()->value());
    }

    public function read()
    {
        return $this->newsRating;
    }
}
