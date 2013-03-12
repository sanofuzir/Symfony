<?php

namespace Sano\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sano\BlogBundle\Entity\Post;

class DefaultController extends Controller
{
    private $manager;

    /**
     * @return PostManager
     */
    private function getPostManager()
    {
        return $this->container->get('sano.post_manager');
    }
    
    /**
     * @Route("/", name="_blog")
     * @Template()
     */
    public function indexAction()
    {
        $post = $this->getPostManager()->findAll();
        if (!$post) {
            throw new $this->createNotFoundException('No Posts found!');
        }
        
        return array( 'post' => $post);
    }
}
