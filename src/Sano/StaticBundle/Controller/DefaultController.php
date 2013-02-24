<?php

namespace Sano\StaticBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="_home")
     * @Template()
     */
    public function indexAction()
    {
        return $this->render('SanoStaticBundle:Default:index.html.twig');
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
