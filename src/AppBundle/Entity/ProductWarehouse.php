<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * ProductWarehouse
 *
 * @ORM\Table()
 * @ORM\Entity
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
     * 
     * 
     */ 
    private $product;   
    
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Warehouse")
     * @ORM\JoinColumn(name="warehouse_id", referencedColumnName="id")
     * 
     */ 
    private $warehouse;   
    
    /**
     * @var integer
     *
     *  @ORM\Column(name="quantity", type="integer")
     * 
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


}
