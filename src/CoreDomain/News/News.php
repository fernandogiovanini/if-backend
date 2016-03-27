<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 20/03/16
 * Time: 11:13.
 */
namespace CoreDomain\News;

use CoreDomain\NewsRating\NewsRatingId;
use CoreDomain\NewsRating\Rating;
use CoreDomain\NewsRating\NewsRating;
use CoreDomain\User\User;

class News
{
    private $id;
    private $url;
    private $title;
    private $cagueiCount;
    private $fodaSeCount;
    private $enfiaNoCuCount;

    public function __construct(NewsId $id, Url $url, $title)
    {
        $this->id = $id;
        $this->url = $url;
        $this->title = $title;
        $this->cagueiCount = 0;
        $this->fodaSeCount = 0;
        $this->enfiaNoCuCount = 0;
    }

    public function rate(Rating $rating, User $user):NewsRating
    {
        return new NewsRating(NewsRatingId::generate(), $this, $rating, $user);
    }

    public function id():NewsId
    {
        return $this->id;
    }

    public function url():Url
    {
        return $this->url;
    }

    public function title():string
    {
        return $this->title;
    }

    public function incrementRatingCount(Rating $rating)
    {
        switch ($rating) {
            case Rating::caguei():
                $this->incrementCagueiCount();
                break;
            case Rating::fodaSe():
                $this->incrementFodaSeCount();
                break;
            case Rating::enfiaNoCu():
                $this->incrementEnfiaNoCuCount();
                break;
        }
    }

    protected function incrementCagueiCount()
    {
        ++$this->cagueiCount;
    }

    protected function incrementFodaSeCount()
    {
        ++$this->fodaSeCount;
    }

    protected function incrementEnfiaNoCuCount()
    {
        ++$this->enfiaNoCuCount;
    }

    public function cagueiCount():int
    {
        return $this->cagueiCount;
    }

    public function fodaSeCount():int
    {
        return $this->fodaSeCount;
    }

    public function enfiaNoCuCount():int
    {
        return $this->enfiaNoCuCount;
    }

    public function equalsTo(News $otherNews):bool
    {
        return $this->id()->equalsTo($otherNews->id());
    }
}
