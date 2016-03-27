<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 27/03/16
 * Time: 11:33.
 */
namespace Application\Service\Rating;

use CoreDomain\NewsRating\NewsRating;

interface NewsRatingDataTransformer{
    public function write(NewsRating $newsRating);
    public function read();
}
