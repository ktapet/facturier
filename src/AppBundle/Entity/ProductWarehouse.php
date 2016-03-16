<?php
//@ORM\Entity 
namespace AppBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;

/**
 * ProductWarehouse
 * 
 * @ORM\Entity
 * @ORM\Table(name="product_warehouse")
 *  
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
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="productWarehouses")
     */
    
    private $product;
    
    /**
     * @ORM\ManyToOne(targetEntity="Warehouse")
     */
    
    private $warehouse;
    
    /**
     * @var integer
     * 
     * @ORM\Column(name="quantity", type="integer")
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
 
}

