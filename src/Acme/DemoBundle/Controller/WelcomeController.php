<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\News;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\NewsForm;

class WelcomeController extends Controller
{
    private $manager;

    /**
     * @return NewsManager
     */
    private function getNewsManager()
    {
        return $this->container->get('acme.news_manager');
    }
    /**
     * @Route("/", name="_home")
     * @Route("/novice/{limit}/{order}", name="_news", defaults={"limit" = 10, "order"= "DESC"})
     * @Template()
     */
    public function indexAction($limit = 2, $order='DESC')
    {
        $news = $this->getNewsManager()->findAllActive($limit, $order);
        
        if (!$news) {
             throw $this->createNotFoundException('No News found!');
         }
         return array( 'news' => $news );
    }
    
    /**
     * @Route("/o_meni", name="_o_meni")
     * @Template()
     */
    public function o_meniAction()
    {
        return $this->render('AcmeDemoBundle:Welcome:o_meni.html.twig');
    }
    
    /**
     * @Route("/reference", name="_reference")
     * @Template()
     */
    public function referenceAction()
    {
        return $this->render('AcmeDemoBundle:Welcome:reference.html.twig');
    }
    
    /**
     * @Route("/blog", name="_blog")
     * @Template()
     */
    public function blogAction()
    {
        return $this->render('AcmeDemoBundle:Welcome:blog.html.twig');
    }
    
    /**
     * @Route("/kontakt", name="_kontakt")
     * @Template()
     */
    public function kontaktAction()
    {
        return $this->render('AcmeDemoBundle:Welcome:kontakt.html.twig');
    }
            
    /**
     * @Route("/novice/{id}", name="_singlenews", requirements={"id" = "\d{1,4}"})
     * @Template()
     */
    public function SingleNewsAction($id)
    {
        $SingleNews = $this->getNewsManager()->getActiveNews($id);
        
        return array( 'news' => $SingleNews );
    }
}

