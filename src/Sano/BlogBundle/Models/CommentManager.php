<?php

namespace Sano\BlogBundle\Models;

use Doctrine\ORM\EntityManager;
use Sano\BlogBundle\Entity\Comment;

class CommentManager {

	private $class;
	private $em;
	private $repository;

    public function __construct(EntityManager $em, $class )
    {
        $this->em = $em;
        $this->class = $class;
        $this->repository = $em->getRepository($class);
    }

    public function findAll()
    {
    	return $this->repository->findAll();
    }
    /**
     * @return Post
     */

    public function findComment($id)
    {
    	return $this->repository->findOneById($id);
    }

    public function saveComment($entity) 
    {
    	if ($entity instanceof $this->class) {
    		$this->em->persist($entity);
        	$this->em->flush();
    	}
    	return $this;
    }

    public function deleteComment($id) 
    {
        $entity = $this->findComment($id);
        
    	if ($entity instanceof $this->class) {
    		$this->em->remove($entity);
        	$this->em->flush();
                return 1;
    	}
        return 0;
    }
    /**
     * @return Comment
     */
    public function createComment($post)
    {
        //ustvariti morim entiteto, ki ima tuj ključ $post, ki je id posta, ki se komentira
        $class = $this->class;
        $entity = new $class();

        return $entity;
    }
    public function getArchive($year, $month)
    {
        return $this->repository->getArchive($year, $month);
    }
    /**
     * @return Comment
     */
    public function getYearsAndMonths($limit)
    {
    	return $this->repository->getYearsAndMonths($limit);
    }
}