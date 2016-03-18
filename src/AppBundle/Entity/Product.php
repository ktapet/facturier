<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Product
 *
 * @ORM\Table()
 * @ORM\Entity
 * 
 * @UniqueEntity("reference")
 * @UniqueEntity("ean")
 * 
 * 
 */
class Product
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
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="UnitMeasure")
     * 
     */ 
    private $unitMeasure;    
    
    /**
     * 
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="products")
     * 
     */
    private $categories;    
    
    /**
     * 
     * @ORM\ManyToMany(targetEntity="Feature", inversedBy="products")
     * 
     * 
     */
    private $features;  
    
    /**
     * 
     * @ORM\ManyToMany(targetEntity="ProductImage", mappedBy="products")
     * 
     * 
     */
    private $images;      
    
    /**
     * 
     * @ORM\OneToMany(targetEntity="ProductWarehouse", mappedBy="product")
     * 
     * 
     */
    private $productWarehouses;       
   
    /**
     * @var string
     *
     * @ORM\Column(name="manufacturer", type="string", nullable=true)
     */
    private $manufacturer;     
    
    /**
     * @var string
     *
     * @ORM\Column(name="ean", type="string", nullable=true)
     */
    private $ean;  
    
    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string")
     */
    private $reference;     
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="sale_price", type="decimal", precision=16, scale=6, nullable=true)
     */
    private $salePrice;    
    
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
     * @inheritDoc
     */
    public function __toString()
    {
        return $this->reference;
    }    
    
 
}
