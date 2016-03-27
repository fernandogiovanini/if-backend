<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 22/03/16
 * Time: 23:51.
 */
namespace Application\Service\Rating;

use CoreDomain\News\News;
use CoreDomain\News\NewsId;
use CoreDomain\News\NewsRepository;
use CoreDomain\News\NewsNotFoundException;
use CoreDomain\NewsRating\NewsRatingRepository;
use CoreDomain\NewsRating\OneNewsRatingPerUserSpecification;
use CoreDomain\NewsRating\Rating;
use CoreDomain\NewsRating\UserAlreadyRatedTheNewsException;
use CoreDomain\User\User;
use CoreDomain\User\UserId;
use CoreDomain\User\UserNotFoundException;
use CoreDomain\User\UserRepository;

class NewsRatingService
{
    private $newsRatingRepository;
    private $userRepository;
    private $newsRepository;
    private $dataTransformer;

    public function __construct(NewsRatingDataTransformer $dataTransformer,
                                NewsRatingRepository $newsRatingRepository,
                                UserRepository $userRepository,
                                NewsRepository $newsRepository)
    {
        $this->newsRatingRepository = $newsRatingRepository;
        $this->userRepository = $userRepository;
        $this->newsRepository = $newsRepository;
        $this->dataTransformer = $dataTransformer;
    }

    public function execute(NewsRatingRequest $request):NewsRatingDataTransformer
    {
        $user = $this->userRepository->findByUserId(UserId::create($request->getUserId()));
        if (!$user instanceof User) {
            throw new UserNotFoundException();
        }

        $news = $this->newsRepository->findByNewsId(NewsId::create($request->getNewsId()));
        if (!$news instanceof News) {
            throw new NewsNotFoundException();
        }

        $newsRating = $news->rate(Rating::fromId($request->getRatingId()), $user);

        $oneNewsRatingPerUserSpecification = new OneNewsRatingPerUserSpecification($this->newsRatingRepository);
        if (!$oneNewsRatingPerUserSpecification->isSatisfiedBy($newsRating)) {
            throw new UserAlreadyRatedTheNewsException();
        }

        $this->newsRatingRepository->add($newsRating);

        $this->dataTransformer->write($newsRating);

        return $this->dataTransformer;
    }
}
