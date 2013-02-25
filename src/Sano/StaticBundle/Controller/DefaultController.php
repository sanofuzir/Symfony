<?php

namespace Sano\StaticBundle\Controller;

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
     * @Route("/", name="_home")
     * @Template()
     */
    public function indexAction()
    {
        $news = $this->getNewsManager()->findAllActive();
        
        if (!$news) {
            throw new $this->createNotFoundException('No News found!');
        }
        
        return array( 'news' => $news );
    }
    
    /**
     * @Route("/kontakt", name="_kontakt")
     * @Template()
     */
    public function kontaktAction()
    {
        return $this->render('SanoStaticBundle:Default:kontakt.html.twig');
    }
    
    /**
     * @Route("/o_meni", name="_o_meni")
     * @Template()
     */
    public function o_meniAction()
    {
        return $this->render('SanoStaticBundle:Default:o_meni.html.twig');
    }
    /**
     * @Route("/ponudba", name="_ponudba")
     * @Template()
     */
    public function ponudbaAction()
    {
        return $this->render('SanoStaticBundle:Default:ponudba.html.twig');
    }
}
