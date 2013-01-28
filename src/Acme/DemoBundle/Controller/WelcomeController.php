<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\NewsAdd;
use Acme\DemoBundle\Entity\User;
use Acme\DemoBundle\Entity\News;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

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
        
     /**
     * @Route("/novice", name="_news")
     * @Template()
     */
    public function NewsAction()
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
    }
    
    /**
     * @Route("/novice/", name="_singlenews")
     * @Template()
     */
    public function SingleNewsAction(Request $request)
    {
        $request = $this->getRequest();
        $id = $request->query->get('id'); // get a $_GET parameter
        //$request->request->get('id'); // get a $_POST parameter
        
        
        $repository = $this->getDoctrine()
                           ->getRepository('AcmeDemoBundle:News');
        
        $news = $repository->findOneById($id);
        
        return $this->render('AcmeDemoBundle:Welcome:SingleNews.html.twig', array(
                        'news' => $news,
                      ));
    }

}

