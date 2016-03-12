<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
 
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;




class Product {
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     */
    private $id;
    
    private $unitMasure;
    
    
    
    private $categories;
    
    private $features;

    private $productWarehouse;
    
    private $manufacturer;
    
    private $reference;
    
    private $salePrice;
    
    private $ean;
    
    private $datUpd;
    
    private $datCre;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="feature", mapedBy="product")
     */
    private $product;
    
    
    
    
}
