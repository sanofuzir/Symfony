<?php
// src/Acme/UserBundle/Entity/User.php

namespace Sano\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="Sano\UserBundle\Entity\UserRepository")
 * @ORM\HasLifecycleCallbacks
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer", nullable=false, unique=true)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="creation_date", type="datetime")
     */
    private $creation_date;

    public function __construct()
    {
        parent::__construct();
        $this->creation_date = new \DateTime('now');
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get creation_date
     *
     * @return \DateTime 
     */
    public function getCreationDate()
    {
        return $this->creation_date;
    }
}