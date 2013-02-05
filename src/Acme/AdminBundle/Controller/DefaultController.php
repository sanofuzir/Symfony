<?php

namespace Acme\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\DemoBundle\Entity\News;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


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
            throw $this->createNotFoundException('No News found!');
        }
        
        return array( 'news' => $news );
    }

    /**
     * @Route("/delete/{id}", name="news_admin_delete", requirements={"id" = "\d{1,4}"})
     *
     * 
     */
    public function deleteNewsAdminAction($id)
    {
        
        $news = $this->getNewsManager()->findNews($id);

        if ($news) {
            $this->getNewsManager()->delete($news);
            $this->get('session')->setFlash('notice', 'Novica Izbrisana!');
            $this->redirect($this->generateUrl('_newsAdmin'));
        }
    }
    
    /**
     * @Route("/admin/novice/add", name="_news_add")
     * @Template()
     */
    public function NewsAddAction(Request $request)
    {
        $news = new NewsAdd();
        $news->setTitle('Write a title');
        $news->setSummary('Write a summary');
        $news->setText('Write a news');
        $news->setStatus('active, draft');
        
        $form = $this->createFormBuilder($news)
        ->add('Title', 'text')
        ->add('Summary', 'text')
        ->add('Text', 'text')
        ->add('Status', 'choice', array(
                'choices' => array('active' => 'Active', 'draft' => 'Draft')))
        ->getForm();
        
        $request = $this->get('request');
        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $date = new \DateTime('now');
                $new_news = new News();
                $new_news->setTitle($news->getTitle());
                $new_news->setSummary($news->getSummary());
                $new_news->setText($news->getText());
                $new_news->setStatus($news->getStatus());
                $new_news->setCreationDate($date);
                $new_news->setEditingDate($date);
                if ($new_news->getStatus() == "active") {
                    $new_news->setPublicationDate($date);
                }else{
                    $new_news->setPublicationDate(NULL);
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($new_news);
                $em->flush();

                $this->get('session')->setFlash('notice', 'Novica dodana!');
                }
            }
            return $this->render('AcmeAdminBundle:Default:new.html.twig', array(
                                        'form' => $form->createView(),
                                        ));
        }
        
     /**
     * @Route("/novice/edit/{id}", name="news_edit")
     * @Route("/novice/add", name="news_add")
     * @Template()
     */
    public function EditAction(Request $request, $id = null)
    {
        if ($id) {
            $entity = $this->getNewsManager()->findNews($id);
            //if (!$entity)
                //throw new  createNotFoundException
        } else {
            $entity = $this->getNewsManager()->createNews();// new News();
        }

        $form  = $this->createForm(new NewsType(), $entity);
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $this->getNewsManager()->saveNews($entity);
                
                $this->get('session')->setFlash('success', 'News was saved!');
                return $this->redirect($this->generateUrl('_newsAdmin'));
            }
        }
        return array(
            'form'   => $form->createView(),
        );  
    } 
}
