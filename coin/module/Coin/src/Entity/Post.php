<?php
namespace Coin\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This class represents a single post in a blog.
 * @ORM\Entity
 * @ORM\Table(name="test")
 */


class Post {

    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** 
     * @ORM\Column(name="name")  
     */
    protected $name;
    /** 
     * @ORM\Column(name="desk")  
     */
    protected $desk;
    

    protected $postArray;

    public function getArray()
    {
        $this->postArray = new ArrayCollection();
    }

    public function getId() 
    {
        return $this->id;
    }
    public function setId($id) 
    {
        $this->id = $id;
    }
    public function getName() 
    {
        return $this->name;
    }
   
    public function setName($title) 
    {
        $this->name = $name;
    }
    public function getDesk() 
    {
        return $this->desk;
    }
   
    public function setDesk($title) 
    {
        $this->desk = $desk;
    }
}