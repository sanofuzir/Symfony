<?php

namespace Acme\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\DemoBundle\Entity\News;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeAdminBundle:Default:index.html.twig');
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
        
        return $this->render('AcmeAdminBundle:Default:news.html.twig', array(
                        'news' => $news,
                      ));
    }
    
    /**
     * @Route("/admin/delete/", name="_deleteNews")
     * @Template()
     */
    public function deleteNewsAdminAction(Request $request)
    {
        $request = $this->getRequest();
        $id = $request->query->get('id');        
        
        $repository = $this->getDoctrine()
                           ->getRepository('AcmeDemoBundle:News');
        
        $NewsToDelete = $repository->findOneById($id);
        
        //brisanje novice
        $em = $this->getDoctrine()->getManager();
                $em->remove($NewsToDelete);
                $em->flush();
                
        $this->get('session')->setFlash('notice', 'Novica Izbrisana!');
        
        $news = $repository->findAll();
        if (!$news) {
            throw $this->createNotFoundException('No News found!');
        }

        return $this->render('AcmeAdminBundle:Default:news.html.twig', array(
                        'news' => $news,
                      ));
    }
    
}
