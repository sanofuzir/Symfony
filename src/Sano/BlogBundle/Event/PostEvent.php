<?php

namespace Sano\BlogBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Sano\BlogBundle\Entity\Post;

class PostEvent extends event {
    
    public function __construct(Post $post) {
        $this->post = $post;
    }
    
    function getPostItem()
    {
        return $this->post;
    }
}
