<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class WelcomeController extends Controller
{
    public function indexAction()
    {
        /*
         * The action's view can be rendered using render() method
         * or @Template annotation as demonstrated in DemoController.
         *
         */
        return $this->render('AcmeDemoBundle:Welcome:index.html.twig');
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
}
