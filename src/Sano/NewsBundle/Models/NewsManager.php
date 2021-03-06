<?php

namespace Sano\NewsBundle\Models;

use Doctrine\ORM\EntityManager;
use Sano\NewsBundle\Entity\News;

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
    
    public function findAllActive($limit = 3)
    {
        return $this->repository->findAllActive($limit);
    }
    /**
     * @return News
     */
    public function getArchive($year, $month)
    {
        return $this->repository->getArchive($year, $month);
    }
    /**
     * @return News
     */
    public function getYearsAndMonths($limit)
    {
    	return $this->repository->getYearsAndMonths($limit);
    }
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

    public function deleteNews($id) 
    {
        $entity = $this->findNews($id);
        
    	if ($entity instanceof $this->class) {
    		$this->em->remove($entity);
        	$this->em->flush();
                return 1;
    	}
        return 0;
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