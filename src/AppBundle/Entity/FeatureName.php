<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\Request;

/**
 * FeatureName
 *
 * @ORM\Table()
 * @ORM\Entity
 * 
 */
class FeatureName
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     */
    private $id;       

    /**
     * @var string
     *
     * @ORM\Column(name="fn_value", type="string", nullable=true)
     */
    private $fnValue;           
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dat_cre", type="datetime")
     */
    private $datCre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dat_upd", type="datetime")
     */
    private $datUpd;     
   
   public function __toString(){
       return (string)$this->getEn();
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
     * Set en
     *
     * @param string $en
     *
     * @return FeatureName
     */
    public function setEn($en)
    {
        $this->en = $en;

        return $this;
    }

    /**
     * Get en
     *
     * @return string
     */
    public function getEn()
    {
        return $this->en;
    }

    /**
     * Set ro
     *
     * @param string $ro
     *
     * @return FeatureName
     */
    public function setRo($ro)
    {
        $this->ro = $ro;

        return $this;
    }

    /**
     * Get ro
     *
     * @return string
     */
    public function getRo()
    {
        return $this->ro;
    }

    /**
     * Set bg
     *
     * @param string $bg
     *
     * @return FeatureName
     */
    public function setBg($bg)
    {
        $this->bg = $bg;

        return $this;
    }

    /**
     * Get bg
     *
     * @return string
     */
    public function getBg()
    {
        return $this->bg;
    }
}
