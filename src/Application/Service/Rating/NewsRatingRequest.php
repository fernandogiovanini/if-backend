<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 22/03/16
 * Time: 23:52.
 */
namespace Application\Service\Rating;

class NewsRatingRequest
{
    private $newsId;
    private $ratingId;
    private $userId;

    public function __construct($newsId, $ratingId, $userId)
    {
        $this->setNewsId($newsId);
        $this->setRatingId($ratingId);
        $this->setUserId($userId);
    }

    private function setNewsId($newsId)
    {
        $this->newsId = $newsId;
    }

    public function getNewsId()
    {
        return $this->newsId;
    }

    private function setRatingId($ratingId)
    {
        $this->ratingId = $ratingId;
    }

    public function getRatingId()
    {
        return $this->ratingId;
    }

    private function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }
}
