<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * ProductWarehouse
 *
 * @ORM\Table(name="product_warehouse")
 * @ORM\Entity
 * 
 *  
 * @ORM\HasLifecycleCallbacks()
 */
class ProductWarehouse
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
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="productWarehouses")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", onDelete="SET NULL")
     * 
     */ 
    private $product;   
    
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Warehouse")
     * @ORM\JoinColumn(name="warehouse_id", referencedColumnName="id", onDelete="SET NULL")
     * 
     */ 
    private $warehouse;   
    
    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     * @Assert\Regex(
     *     pattern="/^[\d+]+$/",
     *     match=true,
     *     message="Number must be positive"
     * )
     */ 
    private $quantity;     

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
        return $this->product;
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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return ProductWarehouse
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set datCre
     * @ORM\PrePersist
     * @param \DateTime $datCre
     *
     * @return ProductWarehouse
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
     * @return ProductWarehouse
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
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return ProductWarehouse
     */
    public function setProduct(\AppBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set warehouse
     *
     * @param \AppBundle\Entity\Warehouse $warehouse
     *
     * @return ProductWarehouse
     */
    public function setWarehouse(\AppBundle\Entity\Warehouse $warehouse = null)
    {
        $this->warehouse = $warehouse;

        return $this;
    }

    /**
     * Get warehouse
     *
     * @return \AppBundle\Entity\Warehouse
     */
    public function getWarehouse()
    {
        return $this->warehouse;
    }
}
