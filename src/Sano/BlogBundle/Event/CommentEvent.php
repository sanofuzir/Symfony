<?php

namespace Sano\BlogBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Sano\BlogBundle\Entity\Comment;

class CommentEvent extends event {
    
    public function __construct(Comment $comment) {
        $this->comment = $comment;
    }
    
    function getCommentItem()
    {
        return $this->post;
    }
}
