<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * ProductImage
 *
 * @ORM\Table()
 * @ORM\Entity
 * 
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
     * 
     * @ORM\ManyToMany(targetEntity="Product", inversedBy="images")
     * 
     */
    private $products;    
   
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=true)
     */
    private $name;     
    
    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", nullable=true)
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
    
    /**
     * @inheritDoc
     */
    public function __toString()
    {
        return $this->reference;
    }    
    
 
}
