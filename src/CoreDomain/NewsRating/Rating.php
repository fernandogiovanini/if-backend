<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 19/03/16
 * Time: 21:06.
 */
namespace CoreDomain\NewsRating;

/**
 * Class Rate.
 */
class Rating
{
    const CAGUEI = '0';
    const FODA_SE = '1';
    const ENFIA_NO_CU = '2';

    private $value;

    private function __construct($rating)
    {
        $this->value = $rating;
    }

    public static function caguei():self
    {
        return new self(self::CAGUEI);
    }

    public static function fodaSe():self
    {
        return new self(self::FODA_SE);
    }

    public static function enfiaNoCu():self
    {
        return new self(self::ENFIA_NO_CU);
    }

    public function value():string
    {
        return $this->value;
    }

    public function equalsTo(Rating $rating):bool
    {
        return $this->value === $rating->value();
    }

    public static function fromId($ratingId)
    {
        switch ($ratingId) {
            case self::CAGUEI:
                return self::caguei();
                break;
            case self::FODA_SE:
                return self::fodaSe();
                break;
            case self::ENFIA_NO_CU:
                return self::enfiaNoCu();
                break;
            default:
                throw new InvalidRatingIdException();
        }
    }
}
