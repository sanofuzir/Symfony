<?php

namespace Sano\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sano\BlogBundle\Entity\Comment;
use Sano\BlogBundle\Entity\Post;
use Sano\BlogBundle\Form\CommentForm;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\EventDispatcher\EventDispatcher;

class CommentController extends Controller
{
    private $manager;

    /**
     * @return CommentManager
     */
    private function getCommentManager()
    {
        return $this->container->get('sano.comment_manager');
    }
    /**
     * @return PostManager
     */
    private function getPostManager()
    {
        return $this->container->get('sano.post_manager');
    }
    
    /**
     * @Route("/comment", name="_comment")
     * @Template()
     */
    public function indexAction()
    {
        $comment = $this->getCommentManager()->findAll();
        if (!$comment) {
            throw new $this->createNotFoundException('No Comment found!');
        }
        
        return array( 'comment' => $comment);
    }
    
    /**
     * @Route("/comment/edit/{id}", name="_editComment")
     * @Template()
     */
    
    public function CommentEditAction(Request $request, $id)
    {
        $entity = $this->getCommentManager()->findComment($id);            

        $form  = $this->createForm(new CommentForm(), $entity);
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                
                $this->getCommentManager()->saveComment($entity);
                $dispatcher = new EventDispatcher();
                $dispatcher->dispatch('sano.news.news_saved', new NewsEvent($entity));

                $this->get('session')->setFlash('notice', 'Comment was edited!');

                return $this->redirect($this->generateUrl('_blog'));
            }
        }

        return array(
                     'form'   => $form->createView(),
                     'id'     => $id,
        );  
    }
    
    /**
     * @Route("/comment/add/post/{id}", name="_addComment")
     * @Template()
     */
    
    public function CommentAddAction(Request $request, $id)
    {
        $comment = $this->getCommentManager()->createComment();
        $post = $this->getPostManager()->findPost($id);
        
        $form  = $this->createForm(new CommentForm(), $comment);
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $comment->setPost($post);
                
                $this->getCommentManager()->saveComment($comment);
                $this->getPostManager()->savePost($post);
                $dispatcher = new EventDispatcher();
                $dispatcher->dispatch('sano.news.news_saved', new NewsEvent($entity));
                
                $this->get('session')->setFlash('notice', 'Comment was added!');

                return $this->redirect($this->generateUrl('_blog'));
            }
        }
        return array(
                     'form'   => $form->createView(),
                     'id'     => $id,
        );  
    }

    /**
     * @Route("Comment/delete/{id}", name="_deleteComment", requirements={"id" = "\d{1,4}"}) 
     */
    
    public function deleteCommentAction($id)
    {
        
        $SingleComment = $this->getCommentManager()->findComment($id);

        if ($SingleComment) {
            $this->getCommentManager()->deleteComment($SingleComment);
            $this->get('session')->setFlash('notice', 'Komentar Izbrisan!');
        }
        return $this->redirect($this->generateUrl('_comment'));
    }
    
    /**
     * @Route("Comment/{id}", name="_singleComment")
     * @Template()
     */
    
    public function singleCommentAction($id)
    {
        $comment = $this->getCommentManager()->findComment($id);
        
        if (!$comment) {
            throw new $this->createNotFoundException('No Comment found!');
        }
        return array( 'comment' => $comment );
    }
    
    public function boxAction($limit)
    {
        $YearsAndMonths = $this->getCommentManager()->getYearsAndMonths($limit);
        
        return $this->render('SanoBlogBundle:Comment:box.html.twig', 
                array( 'YearsAndMonths' => $YearsAndMonths )); 
    }
    
    /**
     * @Route("Comment/{year}/{month}", name="_arhiveComment")
     * @Template()
     */
    
    public function arhiveAction(Request $request, $year=NULL, $month=NULL)
    {        
        $post = $this->getCommentManager()->getArchive($year, $month);

        return array(
                     'year' => $year,
                     'month' => $month,
                     'post' => $post,
        );  
    }
}
