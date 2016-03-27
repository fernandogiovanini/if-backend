<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 27/03/16
 * Time: 09:10.
 */
namespace CoreDomain\NewsRating;

use Ramsey\Uuid\Uuid;

class NewsRatingId
{
    protected $id;

    private function __construct(Uuid $id)
    {
        $this->id = $id->toString();
    }

    public static function generate()
    {
        return new self(Uuid::uuid4());
    }

    public static function create(string $newsRatingId):self
    {
        if (!Uuid::isValid($newsRatingId)) {
            throw new InvalidNewsRatingIdException();
        }

        return new self(Uuid::fromString($newsRatingId));
    }

    public function id()
    {
        return $this->id;
    }

    public function equalsTo(NewsRatingId $newsRatingId):bool
    {
        return $this->id() === $newsRatingId->id();
    }
}
