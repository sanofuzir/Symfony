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
        $minDate = new \DateTime($year . '-' . $month. '-01');
        
        $o = new \ReflectionObject($minDate);   //Bug #49382	can't access DateTime->date
        $p = $o->getProperty('date');
        $date = $p->getValue($minDate);
        
        $maxDate = new \DateTime($date);
        $maxDate->add(new \DateInterval("P1M"));      
        $maxDate->format('Y-m-d H:i:s');  

        return $this->getEntityManager()
                    ->createQuery("SELECT n FROM SanoNewsBundle:news n 
                                    WHERE n.creation_date > :minDate 
                                        AND n.creation_date < :maxDate
                                    ORDER BY n.creation_date DESC")
                    ->setParameters(array(
                                    'minDate' => $minDate,
                                    'maxDate'  => $maxDate,
                                    ))
                    ->getResult();
    }
    public function getYearsAndMonths()
    {
         return $this->getEntityManager()
                    ->createQuery("SELECT YEAR(n.creation_date), MONTH(n.creation_date) 
                                    FROM SanoNewsBundle:news n 
                                    GROUP BY MONTH(n.creation_date)")
                    ->getResult();
    }
}
