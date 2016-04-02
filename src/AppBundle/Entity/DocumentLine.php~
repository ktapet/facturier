<?php
//@ORM\Entity 
namespace AppBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentLine
 * 
 * @ORM\Entity
 * @ORM\Table(name="document_line")
 *  
 */
class DocumentLine
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
     * @ORM\ManyToOne(targetEntity="Product")
     * 
     */
    private $product;
    
    /**
     * @var integer
     * 
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;
    
    /**
     * @var float
     * @ORM\Column(name="sale_price", type="float")
     */
    private $salePrice;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Document", inversedBy="documentLines")
     * 
     */
    private $document;
    
    /**
     * @ORM\ManyToOne(targetEntity="VatRate")
     * 
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