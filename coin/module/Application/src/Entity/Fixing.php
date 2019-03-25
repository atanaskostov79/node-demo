<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * This class represents a tag.
 * @ORM\Entity
 * @ORM\Table(name="fixing")
 */
class Fixing 
{
    /**
     * @ORM\Id
     * @ORM\Column(name="Id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** 
     * @ORM\Column(name="curency") 
     */
    protected $curency;

     /** 
     * @ORM\Column(name="BGN") 
     */
    protected $BGN;

     /** 
     * @ORM\Column(name="USD") 
     */
    protected $USD;

    /** 
     * @ORM\Column(name="EUR") 
     */
    protected $EUR;


    /** 
     * @ORM\Column(name="BTC") 
     */
    protected $BTC;

    /** 
     * @ORM\Column(name="time") 
     */
    protected $time;

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
    public function getid() 
    {
        return $this->id;
    }

    /**
     * Sets ID of this tag.
     * @param int $Id
     */
    public function setid($id) 
    {
        $this->id = $id;
    }

    /**
     * Returns name.
     * @return string
     */
    public function getCurency() 
    {
        return $this->curency;
    }

    /**
     * Sets name.
     * @param string $Name
     */
    public function setCurency($curency) 
    {
        $this->curency = $curency;
    }
    
   /**
     * Returns name.
     * @return string
     */
    public function getBGN() 
    {
        return $this->BGN;
    }

    /**
     * Sets name.
     * @param string $Name
     */
    public function setBGN($BGN) 
    {
        $this->BGN = $BGN;

    }
    /**
     * Returns ImageUrl.
     * @return string
     */
    public function getUSD() 
    {
        return $this->USD;
    }

    /**
     * Sets name.
     * @param string $ImageUrl
     */
    public function setUSD($USD) 
    {
        $this->USD = $USD;
    }

     /**
     * Returns ImageUrl.
     * @return string
     */
    public function getEUR() 
    {
        return $this->EUR;
    }

    /**
     * Sets name.
     * @param string $ImageUrl
     */
    public function setEUR($EUR) 
    {
        $this->EUR = $EUR;
    }


     /**
     * Returns ImageUrl.
     * @return string
     */
    public function getBTC() 
    {
        return $this->BTC;
    }

    /**
     * Sets name.
     * @param string $ImageUrl
     */
    public function setBTC($BTC) 
    {
        $this->BTC = $BTC;
    }


    public function getTime()
    {
        return $this->time;
    }
}

