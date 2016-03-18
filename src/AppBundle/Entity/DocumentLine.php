<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentLine
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class DocumentLine
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;    
    
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;       
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="quantity", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $quantity;      
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="sale_price", type="decimal", precision=16, scale=6, nullable=true)
     */
    private $salePrice;     
     
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Document", inversedBy="documentLines")
     * 
     */
    private $document;    
    
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="VatRate")
     * @ORM\JoinColumn(name="vatrate_id", referencedColumnName="id")
     */
    private $vatRate;        
    
    
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
