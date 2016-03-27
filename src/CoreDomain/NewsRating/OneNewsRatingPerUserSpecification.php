<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 27/03/16
 * Time: 17:41.
 */
namespace CoreDomain\NewsRating;

class OneNewsRatingPerUserSpecification implements NewsRatingSpecification
{
    private $newsRatingRepository;

    public function __construct(NewsRatingRepository $newsRatingRepository)
    {
        $this->newsRatingRepository = $newsRatingRepository;
    }

    public function isSatisfiedBy(NewsRating $newsrating):bool
    {
        $newsRating = $this->newsRatingRepository->findByUserAndNews($newsrating->user(), $newsrating->news());

        return count($newsRating) === 0;
    }
}
