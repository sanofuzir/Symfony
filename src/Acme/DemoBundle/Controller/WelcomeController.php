<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Acme\DemoBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;

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
     * @Route("/test", name="_test")
     * @Template()
     */
    public function testAction()
    {
        /*
        $user = new User();
        $user->setUsername('Sano');
        $user->setPassword('password123');
        $user->setEmail('sano.fuzir@gmail.com');
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return new Response('Created user id '.$user->getId());
         */
        
        /*
        $id="1";
        $user = $this->getDoctrine()
                        ->getRepository('AcmeDemoBundle:User')
                        ->find($id);
        
        return new Response('Created user id je: '.$user->getUsername());
         
        // query by the primary key (usually "id")
        $product = $repository->find($id);
        // dynamic method names to find based on a column value
        $product = $repository->findOneById($id);
        $product = $repository->findOneByName('foo');
        // find *all* products
        $products = $repository->findAll();
        // find a group of products based on an arbitrary column value
        $products = $repository->findByPrice(19.99);
         
        // query for one product matching be name and price
        $product = $repository->findOneBy(array('name' => 'foo', 'price' => 19.99));
        // query for all products matching the name, ordered by price
        $product = $repository->findBy(
        array('name' => 'foo'),
        array('price' => 'ASC')
        ); 
         
         */
    }
}

