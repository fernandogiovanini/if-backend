<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 22/03/16
 * Time: 22:32.
 */
namespace CoreDomain\News;

class Url
{
    private $url;

    public function __construct($url)
    {
        if (false === filter_var($url, FILTER_VALIDATE_URL,
                [FILTER_FLAG_HOST_REQUIRED, FILTER_FLAG_PATH_REQUIRED])) {
            throw new InvalidUrlException();
        }
        $this->url = $url;
    }

    public function url():string
    {
        return $this->url;
    }

    public function equalsTo(Url $url):bool
    {
        return $this->url() === $url->url();
    }
}
