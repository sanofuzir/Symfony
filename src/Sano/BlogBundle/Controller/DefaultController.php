<?php

namespace Sano\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="_blog")
     * @Template()
     */
    public function indexAction()
    {
        return $this->render('SanoBlogBundle:Default:index.html.twig');
    }
}
