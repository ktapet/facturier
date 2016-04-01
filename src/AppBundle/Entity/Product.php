<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Product
 *
 * @ORM\Table()
 * @ORM\Entity
 * 
 * @UniqueEntity("reference")
 * @UniqueEntity("ean")
 * @ORM\HasLifecycleCallbacks()
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
     * @var string
     *
     * @ORM\Column(name="nume", type="string")
     * 
     */
    private $nume; 
    
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
     * @ORM\ManyToMany(targetEntity="Feature", inversedBy="products", cascade={"persist"})
     * 
     */
    private $features;  
    
    /**
     * 
     * @ORM\OneToMany(targetEntity="ProductImage", mappedBy="product", cascade={"persist"}))
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
    
 
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->features = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->productWarehouses = new ArrayCollection();
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
     * Set nume
     *
     * @param string $nume
     *
     * @return Product
     */
    public function setNume($nume)
    {
        $this->nume = $nume;
        return $this;
    }
    
    /**
     * Get nume
     *
     * @return string
     */
    public function getNume()
    {
        return $this->nume;
    }
    
    /**
     * Set manufacturer
     *
     * @param string $manufacturer
     *
     * @return Product
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }
    
    /**
     * Get manufacturer
     *
     * @return string
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Set ean
     *
     * @param string $ean
     *
     * @return Product
     */
    public function setEan($ean)
    {
        $this->ean = $ean;
        return $this;
    }

    /**
     * Get ean
     *
     * @return string
     */
    public function getEan()
    {
        return $this->ean;
    }

    /**
     * Set reference
     *
     * @param string $reference
     *
     * @return Product
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set salePrice
     *
     * @param string $salePrice
     *
     * @return Product
     */
    public function setSalePrice($salePrice)
    {
        $this->salePrice = $salePrice;

        return $this;
    }

    /**
     * Get salePrice
     *
     * @return string
     */
    public function getSalePrice()
    {
        return $this->salePrice;
    }

    /**
     * Set datCre
     * @ORM\PrePersist
     * @param \DateTime $datCre
     *
     * @return Product
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
     * @return Product
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
     * Set unitMeasure
     *
     * @param \AppBundle\Entity\UnitMeasure $unitMeasure
     *
     * @return Product
     */
    public function setUnitMeasure(\AppBundle\Entity\UnitMeasure $unitMeasure = null)
    {
        $this->unitMeasure = $unitMeasure;

        return $this;
    }

    /**
     * Get unitMeasure
     *
     * @return \AppBundle\Entity\UnitMeasure
     */
    public function getUnitMeasure()
    {
        return $this->unitMeasure;
    }

    /**
     * Add category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Product
     */
    public function addCategory(\AppBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \AppBundle\Entity\Category $category
     */
    public function removeCategory(\AppBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add feature
     *
     * @param \AppBundle\Entity\Feature $feature
     *
     * @return Product
     */
    public function addFeature(\AppBundle\Entity\Feature $feature)
    {
        $this->features->add($feature);

        return $this;
    }

    /**
     * Remove feature
     *
     * @param \AppBundle\Entity\Feature $feature
     */
    public function removeFeature(\AppBundle\Entity\Feature $feature)
    {
        $this->features->removeElement($feature);
    }

    /**
     * Get features
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * Add image
     *
     * @param \AppBundle\Entity\ProductImage $image
     *
     * @return Product
     */
    public function addImage(\AppBundle\Entity\ProductImage $image)
    {
        
        $image->setProduct($this);
        
        $this->images->add($image);

    }

    /**
     * Remove image
     *
     * @param \AppBundle\Entity\ProductImage $image
     */
    public function removeImage(\AppBundle\Entity\ProductImage $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add productWarehouse
     *
     * @param \AppBundle\Entity\ProductWarehouse $productWarehouse
     *
     * @return Product
     */
    public function addProductWarehouse(\AppBundle\Entity\ProductWarehouse $productWarehouse)
    {
        $this->productWarehouses[] = $productWarehouse;

        return $this;
    }

    /**
     * Remove productWarehouse
     *
     * @param \AppBundle\Entity\ProductWarehouse $productWarehouse
     */
    public function removeProductWarehouse(\AppBundle\Entity\ProductWarehouse $productWarehouse)
    {
        $this->productWarehouses->removeElement($productWarehouse);
    }

    /**
     * Get productWarehouses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductWarehouses()
    {
        return $this->productWarehouses;
    }
}
