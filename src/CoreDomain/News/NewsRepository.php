<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 25/03/16
 * Time: 21:59.
 */
namespace CoreDomain\News;

interface NewsRepository
{
    public function add(News $news);
    public function findByNewsId(NewsId $newsId);
}
