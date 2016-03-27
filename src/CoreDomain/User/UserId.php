<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 25/03/16
 * Time: 19:03.
 */
namespace CoreDomain\User;

use Ramsey\Uuid\Uuid;

class UserId
{
    protected $id;

    private function __construct($id)
    {
        $this->id = $id->toString();
    }

    public static function create($id):self
    {
        if (!Uuid::isValid($id)) {
            throw new InvalidUserIdException();
        }

        return new self(Uuid::fromString($id));
    }

    public static function generate():self
    {
        return self::create(Uuid::uuid4());
    }

    public function equalsTo(UserId $userId):bool
    {
        return $this->id() === $userId->id();
    }

    public function id()
    {
        return $this->id;
    }
}
