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
        $lastday = strftime("%d", mktime(0, 0, 0, ($month+1), 0, $year));   //last day in month
        $minDate = date("Y-m-d H:i:s", mktime(0,0,0,$month,1,$year));          	//minimalna mejna vrednost, the MySQL DATETIME format
        $maxDate = date("Y-m-d H:i:s", mktime(23,59,59,$month,$lastday,$year));  //maksimalna mejna vrednost, the MySQL DATETIME format
        
        return $this->getEntityManager()
                    ->createQuery("SELECT n FROM SanoNewsBundle:news n 
                                    WHERE n.creation_date > :minDate 
                                        AND n.creation_date < :maxDate
                                    ORDER BY n.creation_date DESC")
                    ->setParameters(array(
                                    'minDate' => date($minDate),
                                    'maxDate'  => date($maxDate),
                                    ))
                    ->getResult();
    }
}
