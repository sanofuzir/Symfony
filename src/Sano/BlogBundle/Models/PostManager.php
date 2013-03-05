<?php

namespace Sano\BlogBundle\Models;

use Doctrine\ORM\EntityManager;
use Sano\BlogBundle\Entity\Post;

class PostManager {

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

    public function findPost($id)
    {
    	return $this->repository->findOneById($id);
    }

    public function savePost($entity) 
    {
    	if ($entity instanceof $this->class) {
    		$this->em->persist($entity);
        	$this->em->flush();
    	}
    	return $this;
    }

    public function deletePost($id) 
    {
        $entity = $this->findPost($id);
        
    	if ($entity instanceof $this->class) {
    		$this->em->remove($entity);
        	$this->em->flush();
                return 1;
    	}
        return 0;
    }
    /**
     * @return Post
     */
    public function createPost()
    {
        $class = $this->class;
        $entity = new $class();

        return $entity;
    }
}