<?php

namespace Sano\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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
     * @Route("/", name="_admin")
     * @Template()
     */
    public function indexAction()
    {
        $user = 'Admin';    //dopolnit da iz SESSION pridobi username
        return array( 'user' => $user);
    }
    
    /**
     * @Route("/blog", name="_AdminBlog")
     * @Template()
     */
    public function blogAction()
    {
        $post = $this->getPostManager()->findAll();
        if (!$post) {
            throw new $this->createNotFoundException('No Posts found!');
        }
        
        return array( 'post' => $post);
    }
}
