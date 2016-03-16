<?php
//@ORM\Entity 
namespace AppBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;

/**
 * ProductImage
 * 
 * @ORM\Entity
 * @ORM\Table(name="product_image")
 *  
 */
class ProductImage
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
     * @ORM\ManyToMany(targetEntity="Product", inversedBy="images")
     */
    private $products;
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     * 
     */
    private $name;     

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string")
     * 
     */
    private $path;
    
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