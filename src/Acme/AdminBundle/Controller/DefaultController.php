<?php

namespace Acme\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\DemoBundle\Entity\News;
use Acme\DemoBundle\Entity\NewsAdd;
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
     * @Route("/admin/novice/edit/", name="_edit")
     * @Template()
     */
    public function EditAction(Request $request)
    {
        $request = $this->getRequest();
        $id = $request->query->get('id');   //pridobivanje id-ja iz url-ja        
        //$id = 12;
        $em = $this->getDoctrine()->getEntityManager();
        $news = $em->getRepository('AcmeDemoBundle:News')->findOneById($id);   //novica, ki jo želim urejati
        
        $new_news = new NewsAdd();                  //ustvarjanje forme
        $new_news->setTitle($news->getTitle());     //prikaz starih podatkov ki jih lahko urejamo
        $new_news->setSummary($news->getSummary());
        $new_news->setText($news->getText());
        $new_news->setStatus($news->getStatus());
        
        $form = $this->createFormBuilder($new_news)
        ->add('Title', 'text')
        ->add('Summary', 'text')
        ->add('Text', 'text')
        ->add('Status', 'choice', array(
                'choices' => array('active' => 'Active', 'draft' => 'Draft')))
        ->getForm();
  
        $request = $this->get('request');       //preverjanje forme.
        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);
            if ($form->isValid()) {
                $date = new \DateTime('now');   //trenutni datum
               
                $news->setTitle($new_news->getTitle());     //nastavitev novih podatkov
                $news->setSummary($new_news->getSummary());
                $news->setText($new_news->getText());
                $news->setStatus($new_news->getStatus());
                $news->setEditingDate($date);
                if ($new_news->getStatus() == "active") {
                    $news->setPublicationDate($date);
                }
                $em = $this->getDoctrine()->getManager();   //update novice
                $em->flush();
                
                $this->get('session')->setFlash('notice', 'Novica urejena!');
                }
            }
            return $this->render('AcmeAdminBundle:Default:Edit.html.twig', array(
                                        'form' => $form->createView(),
                                        'id'   => $id,
                                        ));
    }
    
}
