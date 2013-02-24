<?php

namespace Sano\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="news")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="Sano\NewsBundle\Entity\News")
 * @ORM\HasLifecycleCallbacks
 */
class News
{
    const STATUS_DRAFT = 'DRAFT';
    const STATUS_ACTIVE = 'ACTIVE';
    const DEFAULT_STATUS = 'DRAFT';
    
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
     */
    private $title;
    
    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="text")
     */
    private $summary;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text")
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
     * @ORM\Column(name="editing_date", type="datetime")
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
        $this->status = self::STATUS_DRAFT;
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
        $status = strtoupper($status);

        if (!in_array($status, self::$statuses)) {
            $status = self::DEFAULT_STATUS;
        }
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
     * Set publication_date
     *
     * @param \DateTime $publicationDate
     * @return News
     */
    public function setPublicationDate($date)
    {
        $this->publication_date = $date;
    
        return $this;
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
    
    public static function getAvaliableStatuses()
    {
        //array_merge (self::$statuses, = array('' => , );
        return self::$statuses;
    }
}