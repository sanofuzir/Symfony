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
            $this->redirect($this->generateUrl('_newsAdmin'));
        }
        return $this->redirect($this->generateUrl('_newsAdmin'));
    }
    
    /**
     * @Route("/admin/novice/add", name="_news_add")
     * @Template()
     */
    public function NewsAddAction(Request $request)
    {
        
        $news = new News();
        $news->setTitle('Write a title');
        $news->setSummary('Write a summary');
        $news->setText('Write a news');
        $news->setStatus('active, draft');
        
        $form = $this->createForm(new NewsForm(), $news);
        
        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);
            if ($form->isValid()) {
                
                $new_news = new News();
                $new_news->setTitle($news->getTitle());
                $new_news->setSummary($news->getSummary());
                $new_news->setText($news->getText());
                $new_news->setStatus($news->getStatus());
                $new_news->setCreationDate();
                $new_news->setEditingDate(new \DateTime('now'));
                
                if ($new_news->getStatus() == "active") {
                    $new_news->setPublicationDate(new \DateTime('now'));
                }else{
                    $new_news->setPublicationDate(NULL);
                }
                
                $this->getNewsManager()->saveNews($new_news);
                $this->get('session')->setFlash('notice', 'Novica dodana!');
                }
            }
            return $this->render('AcmeAdminBundle:Default:new.html.twig', array(
                                        'form' => $form->createView(),
                                        ));
        }
        
     /**
     * @Route("/novice/edit/{id}", name="_edit")
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
                $entity->setEditingDate(new \DateTime('now'));
                if ($entity->getStatus() == "active") {
                    $entity->setPublicationDate(new \DateTime('now'));
                }
                $this->getNewsManager()->saveNews($entity);
                $this->get('session')->setFlash('success', 'News was edited!');
                return $this->redirect($this->generateUrl('_newsAdmin'));
            }
        }
        return array(
                     'form'   => $form->createView(),
                     'id'     => $id,
        );  
    } 
}
