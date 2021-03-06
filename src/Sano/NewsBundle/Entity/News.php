<?php

namespace Sano\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * News
 *
 * @ORM\Table(name="news")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Sano\NewsBundle\Entity\NewsRepository")
 * @ORM\HasLifecycleCallbacks
 */
class News
{
    const STATUS_DRAFT = 'Draft';
    const STATUS_ACTIVE = 'Active';
    const DEFAULT_STATUS = 'Draft';
    
    /**
     * @var array
     */
    private static $_statuses = array(
         self::STATUS_DRAFT,
         self::STATUS_ACTIVE
    );

    private static $_statusLabes = array(
        'Draft',
        'Active'
    );
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
    * @var string
    *
    * @ORM\Column(name="title", type="string", length=255)
    * @Assert\NotBlank(message="to polje ne sme biti prazno")
    * @Assert\MinLength(
    * limit=3,
    * message="Your title must have at least {{ limit }} characters!")
    * @Assert\MaxLength(
    * limit=100,
    * message="Predolgo besedilo, naslov lahko vsebuje do {{ limit }} znakov")
    */
    private $title;
    
    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="text")
     * @Assert\NotBlank(message="to polje ne sme biti prazno")
     * @Assert\MinLength(
     * limit=3,
     * message="Your title must have at least {{ limit }} characters!")
     */
    private $summary;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
     * @Assert\NotBlank(message="to polje ne sme biti prazno")
     * @Assert\MinLength(
     * limit=5,
     * message="Your title must have at least {{ limit }} characters!")
     */
    private $text;
    
    /**
     * @var string
     *
     * @ORM\Column(name="status", type="text", nullable=false)
     */
    private $status;
    
    /**
     * @var string
     *
     * @ORM\Column(name="creation_date", type="datetime")
     */
    private $creation_date;
    
    /**
     * @var string
     *
     * @ORM\Column(name="editing_date", type="datetime", nullable=true)
     */
    private $editing_date;
    
    /**
     * @var string
     *
     * @ORM\Column(name="publication_date", type="datetime", nullable=true)
     */
    private $publication_date;
    
    public function __construct() {
        $this->creation_date = new \DateTime('now');
        $this->publication_date = new \DateTime('now');
        $this->status = self::STATUS_ACTIVE;
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
     * Set title
     *
     * @param string $title
     * @return News
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return News
     */
    public function setText($text)
    {
        $this->text = $text;
    
        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }


    /**
     * Set summary
     *
     * @param string $summary
     * @return News
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    
        return $this;
    }

    /**
     * Get summary
     *
     * @return string 
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return News
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
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

    /**
     * Set editing_date
     *
     * @param \DateTime $editingDate
     * @return News
     * @ORM\PreUpdate
     */
    public function setEditingDate()
    {
        $this->editing_date = new \DateTime('now');
    
        return $this;
    }

    /**
     * Get editing_date
     *
     * @return \DateTime 
     */
    public function getEditingDate()
    {
        return $this->editing_date;
    }

    /**
     * Get publication_date
     *
     * @return \DateTime 
     */
    public function getPublicationDate()
    {
        return $this->publication_date;
    }

    /**
     * Set creation_date
     *
     * @param \DateTime $creationDate
     * @return News
     */
    public function setCreationDate($creationDate)
    {
        $this->creation_date = $creationDate;
    
        return $this;
    }
}