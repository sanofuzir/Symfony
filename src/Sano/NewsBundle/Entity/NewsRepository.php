<?php

namespace Sano\NewsBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * NewsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NewsRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT n FROM SanoNewsBundle:news n ORDER BY n.creation_date DESC')
                    ->getResult();
    }
    
    public function findAllActive($limit)
    {
        return $this->getEntityManager()
                    ->createQuery("SELECT n FROM SanoNewsBundle:news n 
                                    WHERE n.status = 'active'
                                    ORDER BY n.creation_date DESC")
                    ->setMaxResults($limit)
                    ->getResult();
    }
    public function getArchive($year, $month)
    {    
        $rsm = new \Doctrine\ORM\Query\ResultSetMapping;
        $rsm->addEntityResult('SanoNewsBundle:news', 'news');        

        return $this->getEntityManager()                    
                    ->createNativeQuery("SELECT * FROM news 
                                            WHERE YEAR(creation_date)= ?
                                            AND MONTH(creation_date)= ?
                                            ORDER BY creation_date DESC", $rsm)
                    ->setParameters(array(1 => $year, 2 => $month))
                    ->getResult(); 
    }
}
