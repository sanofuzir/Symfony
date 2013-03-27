<?php

namespace Sano\NewsBundle\Event;
use Symfony\Component\EventDispatcher\Event;

class NewsEvent extends event {
    
    public function __construct(News $news) {
        $this->news = $news;
    }
    
    function getNewsItem()
    {
        return $this->news;
    }
}
