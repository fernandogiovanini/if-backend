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
use CoreDomain\News\Rating;
use CoreDomain\User\User;
use CoreDomain\User\UserId;
use CoreDomain\User\UserNotFoundException;
use CoreDomain\User\UserRepository;

class NewsRatingService
{
    private $userRepository;
    private $newsRepository;
    private $dataTransformer;

    public function __construct(NewsRatingDataTransformer $dataTransformer,
                                UserRepository $userRepository,
                                NewsRepository $newsRepository)
    {
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

        $news->rate(Rating::fromId($request->getRatingId()), $user);

        $this->newsRepository->add($news);

        $this->dataTransformer->write($news, $user, $news->userRating($user));

        return $this->dataTransformer;
    }
}
