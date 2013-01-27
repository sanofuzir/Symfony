<?php

namespace Acme\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\DemoBundle\Entity\News;



class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcmeAdminBundle:Default:index.html.twig', array('name' => $name));
    }
    
    /**
     * @Route("/admin/novice", name="_newsAdmin")
     * @Template()
     */
    public function newsAdminAction()
    {
        $repository = $this->getDoctrine()
                           ->getRepository('AcmeDemoBundle:News');
        
        $news = $repository->findAll();
        
        if (!$news) {
            throw $this->createNotFoundException('No News found!');
        }
        
        return $this->render('AcmeDemoBundle:Welcome:news.html.twig', array(
                        'news' => $news,
                      ));
        
        return $this->render('AcmeAdminBundle:Default:index.html.twig');
    }
}
