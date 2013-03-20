<?php

namespace Sano\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommentRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->getEntityManager()
                    ->createQuery('SELECT c FROM SanoBlogBundle:comment c ORDER BY c.creation_date DESC')
                    ->getResult();
    }
    public function getArchive($year, $month)
    {
        $fromDay = new \DateTime("$year-$month-01");
        $toDay = clone $fromDay;
        $toDay->add(new \DateInterval('P1M'));

        return $this->getEntityManager()
                            ->createQuery("SELECT c FROM SanoBlogBundle:comment c
                                            WHERE c.creation_date >= :minDate
                                                AND c.creation_date < :maxDate
                                            ORDER BY c.creation_date DESC")
                            ->setParameters(array(
                                            'minDate' => $fromDay,
                                            'maxDate'  => $toDay,
                                            ))
                            ->getResult();
    }
    public function getYearsAndMonths($limit)
    {
         return $this->getEntityManager()
                     ->createQuery("SELECT YEAR(c.creation_date) AS year, MONTH(c.creation_date) AS month
                                    FROM SanoBlogBundle:comment c  
                                    GROUP BY year, month")
                     ->setMaxResults($limit)
                     ->getResult();
    }
    public function findAllByPost($id)
    {
        return $this->getEntityManager()
                     ->createQuery("SELECT c FROM SanoBlogBundle:comment c
                                            WHERE c.post = :post
                                            ORDER BY c.creation_date ASC")
                     ->setParameters(array(
                                     'post' => $id
                                     ))
                     ->getResult();
    }
}
