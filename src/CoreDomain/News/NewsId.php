<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 22/03/16
 * Time: 22:34.
 */
namespace CoreDomain\News;

use Ramsey\Uuid\Uuid;

class NewsId
{
    protected $id;

    private function __construct(Uuid $id)
    {
        $this->id = $id->toString();
    }

    public static function create($id):self
    {
        if (!Uuid::isValid($id)) {
            throw new InvalidNewsIdException();
        }

        return new self(Uuid::fromString($id));
    }

    public static function generate():self
    {
        return self::create(Uuid::uuid4());
    }

    public function equalsTo(NewsId $newsId):bool
    {
        return $this->id() === $newsId->id();
    }

    public function id()
    {
        return $this->id;
    }
}
