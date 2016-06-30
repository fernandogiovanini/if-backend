<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 22/03/16
 * Time: 22:25.
 */
namespace CoreDomain\News;

use CoreDomain\User\User;

class NewsRating
{
    private $rating;
    private $user;

    public function __construct(Rating $rating, User $user)
    {
        $this->rating = $rating;
        $this->user = $user;
    }

    public function rating():Rating
    {
        return $this->rating;
    }

    public function user():User
    {
        return $this->user;
    }

    public function wasRatedBy(User $user):bool
    {
        return $this->user()->equalsTo($user);
    }

    public function wasRatedAs(Rating $rating):bool
    {
        return $this->rating()->equalsTo($rating);
    }
}
