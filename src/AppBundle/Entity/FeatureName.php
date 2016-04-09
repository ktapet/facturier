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
 * @ORM\HasLifecycleCallbacks()
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
       return $this->fnValue;
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
     * Set fnValue
     *
     * @param string $fnValue
     *
     * @return FeatureName
     */
    public function setFnValue($fnValue)
    {
        $this->fnValue = $fnValue;
        return $this;
    }

    /**
     * Get fnValue
     *
     * @return string
     */
    public function getFnValue()
    {
        return $this->fnValue;
    }

    /**
     * Set datCre
     * @ORM\PrePersist
     * @param \DateTime $datCre
     *
     * @return FeatureName
     */
    public function setDatCre()
    {
        $this->datCre = new \Datetime();
        return $this;
    }

    /**
     * Get datCre
     *
     * @return \DateTime
     */
    public function getDatCre()
    {
        return $this->datCre;
    }

    /**
     * Set datUpd
     * @ORM\PreUpdate
     * @ORM\PrePersist
     * @param \DateTime $datUpd
     *
     * @return FeatureName
     */
    public function setDatUpd()
    {
        $this->datUpd = new \DateTime();
        return $this;
    }

    /**
     * Get datUpd
     *
     * @return \DateTime
     */
    public function getDatUpd()
    {
        return $this->datUpd;
    }
}
