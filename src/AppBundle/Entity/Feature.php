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
 * 
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
     * @ORM\Column(name="f_value", type="string", nullable=true)
     */
    private $value;
    
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
     *
     * @param \DateTime $datCre
     *
     * @return Feature
     */
    public function setDatCre($datCre)
    {
        $this->datCre = $datCre;

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
     *
     * @param \DateTime $datUpd
     *
     * @return Feature
     */
    public function setDatUpd($datUpd)
    {
        $this->datUpd = $datUpd;

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
}
