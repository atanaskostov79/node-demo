<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This class represents a tag.
 * @ORM\Entity
 * @ORM\Table(name="coinlist")
 */
class Coin 
{
    /**
     * @ORM\Id
     * @ORM\Column(name="Id")
     * @ORM\GeneratedValue
     */
    protected $Id;

    /** 
     * @ORM\Column(name="Name") 
     */
    protected $Name;

     /** 
     * @ORM\Column(name="FullName") 
     */
    protected $FullName;

     /** 
     * @ORM\Column(name="ImageUrl") 
     */
    protected $ImageUrl;

    protected $coinArray;
    
    /**
     * Constructor.
     */
    public function __construct() 
    {        
        $this->coinArray = new ArrayCollection();        
    }

    /**
     * Returns ID of this tag.
     * @return integer
     */
    public function getId() 
    {
        return $this->Id;
    }

    /**
     * Sets ID of this tag.
     * @param int $Id
     */
    public function setId($Id) 
    {
        $this->Id = $Id;
    }

    /**
     * Returns name.
     * @return string
     */
    public function getName() 
    {
        return $this->Name;
    }

    /**
     * Sets name.
     * @param string $Name
     */
    public function setName($Name) 
    {
        $this->Name = $Name;
    }
    
   /**
     * Returns name.
     * @return string
     */
    public function getFullName() 
    {
        return $this->FullName;
    }

    /**
     * Sets name.
     * @param string $Name
     */
    public function setFullName($FullName) 
    {
        $this->FullName = $FullName;

    }
    /**
     * Returns ImageUrl.
     * @return string
     */
    public function getImageUrl() 
    {
        return $this->ImageUrl;
    }

    /**
     * Sets name.
     * @param string $ImageUrl
     */
    public function setImageUrl($ImageUrl) 
    {
        $this->ImageUrl = $ImageUrl;
    }
}

