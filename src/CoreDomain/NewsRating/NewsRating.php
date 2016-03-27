<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 22/03/16
 * Time: 22:25.
 */
namespace CoreDomain\NewsRating;

use CoreDomain\News\News;
use CoreDomain\User\User;

class NewsRating
{
    private $id;
    private $news;
    private $rating;
    private $user;

    public function __construct(NewsRatingId $newsRatingId, News $news, Rating $rating, User $user)
    {
        $this->id = $newsRatingId;
        $this->news = $news;
        $this->rating = $rating;
        $this->user = $user;
    }

    public function news():News
    {
        return $this->news;
    }

    public function rating():Rating
    {
        return $this->rating;
    }

    public function user():User
    {
        return $this->user;
    }

    public function id():NewsRatingId
    {
        return $this->id;
    }

    public function wasNewsRatedBy(News $news, User $user):bool
    {
        return $this->news()->equalsTo($news) &&
                $this->user()->equalsTo($user);
    }
}
