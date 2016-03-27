<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 27/03/16
 * Time: 11:47.
 */
namespace Application\Service\Rating;

class NewsRatingDto
{
    private $newsRatingId;
    private $userId;
    private $newsId;
    private $rating;

    /**
     * @return mixed
     */
    public function getNewsRatingId()
    {
        return $this->newsRatingId;
    }

    /**
     * @param mixed $newsRatingId
     */
    public function setNewsRatingId($newsRatingId)
    {
        $this->newsRatingId = $newsRatingId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getNewsId()
    {
        return $this->newsId;
    }

    /**
     * @param mixed $newsId
     */
    public function setNewsId($newsId)
    {
        $this->newsId = $newsId;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }
}
