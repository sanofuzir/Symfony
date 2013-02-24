<?php

namespace Acme\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\DemoBundle\Entity\News;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\NewsForm;

/**
 * @Route("/admin")
 * @Route("/admin/novice")
 */
class DefaultController extends Controller
{

    private $manager;

    /**
     * @return NewsManager
     */
    private function getNewsManager()
    {
        return $this->container->get('acme.news_manager');
    }

    /**
     * @Route("/novice", name="_newsAdmin")
     * @Route("/", name="_newsAdmin")
     * @Template("AcmeAdminBundle:Default:news.html.twig")
     */
    public function indexAction()
    {
        $news = $this->getNewsManager()->findAll();
        
        if (!$news) {
            throw new $this->createNotFoundException('No News found!');
        }
        
        return array( 'news' => $news );
    }

    /**
     * @Route("/delete/{id}", name="_deleteNews", requirements={"id" = "\d{1,4}"}) 
     */
    public function deleteNewsAdminAction($id)
    {
        
        $SingleNews = $this->getNewsManager()->findNews($id);

        if ($SingleNews) {
            $this->getNewsManager()->deleteNews($SingleNews);
            $this->get('session')->setFlash('notice', 'Novica Izbrisana!');
        }
        return $this->redirect($this->generateUrl('_newsAdmin'));
    }
        
     /**
     * @Route("/novice/edit/{id}", name="_edit")
      * @Route("/add", name="_news_add")
      * @Route("/edit/{id}", name="_edit")
     * @Template()
     */
    public function EditAction(Request $request, $id)
    {
        if ($id) {
            $entity = $this->getNewsManager()->findNews($id);            
        } else {
            $entity = $this->getNewsManager()->createNews();
        }
        $form  = $this->createForm(new NewsForm(), $entity);
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                
                $this->getNewsManager()->saveNews($entity);
                if ($id) {
                   $this->get('session')->setFlash('success', 'News was edited!');
                } else {
                    $this->get('session')->setFlash('success', 'News was added!');
                }
                return $this->redirect($this->generateUrl('_newsAdmin'));
            }
        }
        return array(
                     'form'   => $form->createView(),
                     'id'     => $id,
        );  
    } 
}
