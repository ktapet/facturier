<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\Request;

/**
 * Feature
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Feature
{
    /**
     * 
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     */
    private $id;       
    
    /**
     * 
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="features")
     * 
     */
    private $products;         
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="FeatureName")
     * @ORM\JoinColumn(name="name_id", referencedColumnName="id")
     * 
     */
    private $name;   
    
    /**
     * @var string
     *
     * @ORM\Column(name="en", type="string", nullable=true)
     */
    private $en;         
    
    /**
     * @var string
     *
     * @ORM\Column(name="ro", type="string", nullable=true)
     */
    private $ro;       
    
     /**
     * @var string
     *
     * @ORM\Column(name="bg", type="string", nullable=true)
     */
    private $bg;   
    
    /**
     * 
     */
    public function __toString()
    {        
        return $this->value;
    }    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set value
     *
     * @param string $value
     *
     * @return Feature
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set datCre
     * @ORM\PrePersist
     * @param \DateTime $datCre
     *
     * @return Feature
     */
    public function setDatCre($datCre)
    {
        $this->datCre = new \DateTime();

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
     * @return Feature
     */
    public function setDatUpd($datUpd)
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

    /**
     * Add product
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return Feature
     */
    public function addProduct(\AppBundle\Entity\Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \AppBundle\Entity\Product $product
     */
    public function removeProduct(\AppBundle\Entity\Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set name
     *
     * @param \AppBundle\Entity\FeatureName $name
     *
     * @return Feature
     */
    public function setName(\AppBundle\Entity\FeatureName $name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return \AppBundle\Entity\FeatureName
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set en
     *
     * @param string $en
     *
     * @return Feature
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
     * @return Feature
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
     * @return Feature
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
