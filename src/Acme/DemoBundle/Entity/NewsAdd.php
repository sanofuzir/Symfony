<?php

namespace Acme\DemoBundle\Entity;

class NewsAdd
{
    protected $title;
    protected $summary;
    protected $text;
    protected $status;
    protected $creation_date;
    protected $editing_date;
    protected $publication_date;
   
    public function getTitle()
    {
        return $this->title;
    }
    
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    public function getSummary()
    {
        return $this->summary;
    }
    
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }
    
    public function getText()
    {
        return $this->text;
    }
    
    public function setText($text)
    {
        $this->text = $text;
    }
    
    public function getStatus()
    {
        return $this->status;
    }
    
    public function setStatus($status)
    {
        $this->status = $status;
    }

     public function getCreationDate()
    {
        return $this->creation_date;
    }
    
    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date;
    }
    
     public function getEditingDate()
    {
        return $this->editing_date;
    }
    
    public function setEditingDate($editing_date)
    {
        $this->editing_date = $editing_date;
    }
    
     public function getPublicationDate()
    {
        return $this->publication_date;
    }
    
    public function setPublicationDate($publication_date)
    {
        $this->publication_date = $publication_date;
    }
    
}
?>
