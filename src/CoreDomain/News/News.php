<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 20/03/16
 * Time: 11:13.
 */
namespace CoreDomain\News;

use CoreDomain\User\User;
use Doctrine\Common\Collections\ArrayCollection;

class News
{
    private $id;
    private $url;
    private $title;
    private $publishedDate;
    private $newsRating;

    private $cagueiCount;
    private $fodaSeCount;
    private $enfiaNoCuCount;

    public function __construct(NewsId $id, Url $url, $title/*, \DateTime $publishedDate*/)
    {
        $this->id = $id;
        $this->url = $url;
        $this->title = $title;
//        $this->publishedDate = $publishedDate;
        $this->newsRating = new ArrayCollection();

        $this->cagueiCount = 0;
        $this->fodaSeCount = 0;
        $this->enfiaNoCuCount = 0;
    }

    public function rate(Rating $rating, User $user)
    {
        if ($this->wasRatedBy($user)) {
            throw new UserAlreadyRatedTheNewsException();
        }
        $this->newsRating->add(new NewsRating($rating, $user));
    }

    public function wasRatedByUserAs(Rating $rating, User $user):bool
    {
        foreach ($this->newsRating as $newsRating) {
            if ($newsRating->wasRatedBy($user) && $newsRating->wasRatedAs($rating)) {
                return true;
            }
        }

        return false;
    }

    public function wasRatedBy(User $user):bool
    {
        try {
            $this->userRating($user);
        } catch (UserRatingNotFoundException $e) {
            return false;
        }

        return true;
    }

    public function userRating(User $user):Rating
    {
        foreach ($this->newsRating as $newsRating) {
            if ($newsRating->wasRatedBy($user)) {
                return $newsRating->rating();
            }
        }
        throw new UserRatingNotFoundException();
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
