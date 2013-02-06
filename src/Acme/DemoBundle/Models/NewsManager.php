<?php

namespace Acme\DemoBundle\Models;

use Doctrine\ORM\EntityManager;

class NewsManager {

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
     * @return News
     */
    public function findNews($id)
    {
    	return $this->repository->findOneById($id);
    }

    public function saveNews($entity) 
    {
    	if ($entity instanceof $this->class) {
    		$this->em->persist($entity);
        	$this->em->flush();
    	}
    	return $this;
    }

    public function deleteNews($entity) 
    {
    	if ($entity instanceof $this->class) {
    		$this->em->remove($entity);
        	$this->em->flush();
    	}
    }
    /**
     * @return News
     */
    public function createNews()
    {
        $class = $this->class;
        $entity = new $class();

        return $entity;
    }
}