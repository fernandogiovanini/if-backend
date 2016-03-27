<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 27/03/16
 * Time: 17:11.
 */
namespace CoreDomain\NewsRating;

interface NewsRatingSpecification
{
    public function isSatisfiedBy(NewsRating $newsrating):bool;
}
