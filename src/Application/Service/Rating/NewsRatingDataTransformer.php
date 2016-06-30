<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 27/03/16
 * Time: 11:33.
 */
namespace Application\Service\Rating;

use CoreDomain\News\News;
use CoreDomain\News\Rating;
use CoreDomain\User\User;

interface NewsRatingDataTransformer
{
    public function write(News $news, User $user, Rating $rating);
    public function read();
}
