<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\Request;

/**
 * Feature
 *
 * @ORM\Table()
 * @ORM\Entity
 * 
 */
class Feature
{
    /**
     * 
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
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="features")
     * 
     */
    private $products;         
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="FeatureName")
     * @ORM\JoinColumn(name="name_id", referencedColumnName="id")
     * 
     */
    private $name;   
    
    /**
     * @var string
     *
     * @ORM\Column(name="f_value", type="string", nullable=true)
     */
    private $value;
    
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
     * 
     */
    public function __toString()
    {        
        return $this->value;
    }    

}
