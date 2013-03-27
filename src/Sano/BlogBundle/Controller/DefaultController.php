<?php

namespace Sano\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sano\BlogBundle\Entity\Post;
use Sano\BlogBundle\Entity\Comment;
use Sano\BlogBundle\Form\PostForm;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\EventDispatcher\EventDispatcher;

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
     * @return CommentManager
     */
    private function getCommentManager()
    {
        return $this->container->get('sano.comment_manager');
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
    
    /**
     * @Route("/edit/{id}", name="_editPost")
     * @Route("/add", name="_addPost")
     * @Template()
     */
    public function EditAction(Request $request, $id=NULL)
    {
        if ($id!=NULL) {
            $entity = $this->getPostManager()->findPost($id);            
        } else {
            $entity = $this->getPostManager()->createPost();
        }
        $form  = $this->createForm(new PostForm(), $entity);
        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) { 
                $this->getPostManager()->savePost($entity);
                $dispatcher = new EventDispatcher();
                $dispatcher->dispatch('sano.news.news_saved', new NewsEvent($entity));
                if ($id) {
                   $this->get('session')->setFlash('notice', 'Post was edited!');
                } else {
                    $this->get('session')->setFlash('notice', 'Post was added!');
                }
                return $this->redirect($this->generateUrl('_blog'));
            }
        }

        return array(
                     'form'   => $form->createView(),
                     'id'     => $id,
        );  
    }
    
    /**
     * @Route("/delete/{id}", name="_deletePost", requirements={"id" = "\d{1,4}"}) 
     */
    public function deletePostAdminAction($id)
    {
        
        $SinglePost = $this->getPostManager()->findPost($id);

        if ($SinglePost) {
            $this->getPostManager()->deletePost($SinglePost);
            $this->get('session')->setFlash('notice', 'Objava Izbrisana!');
        }
        return $this->redirect($this->generateUrl('_blog'));
    }
    
    /**
     * @Route("/{id}", name="_singlePost")
     * @Template()
     */
    public function singlePostAction($id)
    {
        $post = $this->getPostManager()->findPost($id);
        $comment = $this->getCommentManager()->findAllByPost($id);
        
        if (!$post) {
            throw new $this->createNotFoundException('No Post found!');
        }
        return array( 'post' => $post,
                      'comment' => $comment,
                    );
    }
    
    public function boxAction($limit)
    {
        $YearsAndMonths = $this->getPostManager()->getYearsAndMonths($limit);
        
        return $this->render('SanoBlogBundle:Default:box.html.twig', 
                array( 'YearsAndMonths' => $YearsAndMonths )); 
    }
    
    /**
     * @Route("/{year}/{month}", name="_arhivePost")
     * @Template()
     */
    public function arhiveAction(Request $request, $year=NULL, $month=NULL)
    {        
        $post = $this->getPostManager()->getArchive($year, $month);

        return array(
                     'year' => $year,
                     'month' => $month,
                     'post' => $post,
        );  
    }
}
