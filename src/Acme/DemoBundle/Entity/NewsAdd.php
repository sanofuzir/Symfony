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
    
}
?>
