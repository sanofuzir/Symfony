<?php

namespace Sano\NewsBundle\EventListener;

use Symfony\Component\EventDispatcher\Event;

class NewsNotificationListener {
    
    protected $mailer;
    
    public function __construct(\Swift_Mailer $mailer) {
        $this->mailer = $mailer;
    }
    
    public function onNewsSave(Event $event)
    {   
        $news = $event->getNewsItem();
        
        $message = \Swift_Message::newInstance()
            ->setSubject('New news has been added')
            ->setFrom('sano.fuzir@gmail.com')
            ->setTo('sano.fuzir@gmail.com')
            ->setBody(
                $this->render('SanoNewsBundle:Default:email.html.twig',
                                array('news' => $news)
                              )
                );
        $this->get('mailer')->send($message);
    }
}