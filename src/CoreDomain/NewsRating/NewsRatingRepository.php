<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 25/03/16
 * Time: 11:00.
 */
namespace CoreDomain\NewsRating;

use CoreDomain\News\News;
use CoreDomain\User\User;

interface NewsRatingRepository
{
    public function add(NewsRating $newsRating);
    public function findByUserAndNews(User $user, News $news);
}
