<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Acme\DemoBundle\Entity\User;
use Acme\DemoBundle\Entity\Image;

/**
 * Post
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Post
{
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
     * @ORM\Column(name="text", type="text")
     */
    private $text;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="ads")
     * @ORM\JoinColumn(name="user", referencedColumnName="id", nullable=false)
     */
    private $user;
    
    /**
     * @var Image
     *
     * @ORM\ManyToOne(targetEntity="Image", inversedBy="ads")
     * @ORM\JoinColumn(name="image", referencedColumnName="id", nullable=false)
     */
    private $image;
    
    /**
     * @var Video
     *
     * @ORM\ManyToOne(targetEntity="Video", inversedBy="ads")
     * @ORM\JoinColumn(name="video", referencedColumnName="id", nullable=false)
     */
    private $video;

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
     * @return Post
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
     * @return Post
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
     * Set user
     *
     * @param User $user
     * @return Ad
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return User 
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * Set image
     *
     * @param Image $image
     * @return Ad
     */
    public function setImage(Image $image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Get image
     *
     * @return Image 
     */
    public function getImage()
    {
        return $this->image;
    }
    
    /**
     * Set video
     *
     * @param Video $image
     * @return Ad
     */
    public function setVideo(Video $video)
    {
        $this->video = $video;
        return $this;
    }

    /**
     * Get video
     *
     * @return Video 
     */
    public function getVideo()
    {
        return $this->video;
    }
}