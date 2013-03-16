<?php

namespace Sano\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="_admin")
     * @Template()
     */
    public function indexAction()
    {
        $user = 'Admin';    //dopolnit da iz SESSION pridobi username
        return array( 'user' => $user);
    }
}
