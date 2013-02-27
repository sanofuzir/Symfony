<?php

namespace Sano\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sano\NewsBundle\Entity\News;
use Sano\NewsBundle\Form\NewsForm;
use Sano\NewsBundle\Form\sortNewsForm;

class DefaultController extends Controller
{
    private $manager;

    /**
     * @return NewsManager
     */
    private function getNewsManager()
    {
        return $this->container->get('sano.news_manager');
    }
    
    /**
     * @Route("/", name="_news")
     * @Route("/{year}", name="_sortedNews")
     * @Template()
     */
    public function indexAction(Request $request, $year = NULL)
    {
        $form  = $this->createForm(new sortNewsForm());
        
        var_dump($year);
        
        if ($year!=NULL) {
            if ($request->isMethod('POST')) {
                $form->bind($request);
                if ($form->isValid()) {
                    $news = $this->getNewsManager()->getSortedNews($year);
                }
            }
        }else{
            $news = $this->getNewsManager()->findAll();
        }
        var_dump($news);
        if (!$news) {
            throw new $this->createNotFoundException('No News found!');
        }
        
        return array( 'news' => $news,
                      'year' => $year,
                      'form'   => $form->createView(),
            );
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
        return $this->redirect($this->generateUrl('_news'));
    }
    
    /**
     * @Route("/edit/{id}", name="_editNews")
     * @Route("/add", name="_addNews")
     * @Template()
     */
    public function EditAction(Request $request, $id=NULL)
    {
        if ($id!=NULL) {
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
                   $this->get('session')->setFlash('notice', 'News was edited!');
                } else {
                    $this->get('session')->setFlash('notice', 'News was added!');
                }
                return $this->redirect($this->generateUrl('_news'));
            }
        }
        return array(
                     'form'   => $form->createView(),
                     'id'     => $id,
        );  
    } 
    
    /**
     * @Route("/{id}", name="_singleNews")
     * @Template()
     */
    public function singleNewsAction($id)
    {
        $news = $this->getNewsManager()->findNews($id);
        
        if (!$news) {
            throw new $this->createNotFoundException('No News found!');
        }
        return array( 'news' => $news );
    }
}
