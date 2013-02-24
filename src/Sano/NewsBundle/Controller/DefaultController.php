<?php

namespace Sano\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sano\NewsBundle\Entity\News;

class DefaultController extends Controller
{
    private $manager;

    /**
     * @return NewsManager
     */
    private function getNewsManager()
    {
        return $this->container->get('sano.news_manager');
    }
    
    /**
     * @Route("/", name="_news")
     * @Template()
     */
    public function indexAction()
    {
        $news = $this->getNewsManager()->findAll();
        
        if (!$news) {
            throw new $this->createNotFoundException('No News found!');
        }
        
        return array( 'news' => $news );
    }
}
