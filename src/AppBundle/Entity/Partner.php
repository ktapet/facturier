<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
 
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 *  Partner
 * 
 * @ORM\Table(name="partner")
 * @ORM\Entity
 * 
 */
class Partner {
    
    
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
     * @var string 
     * 
     * 
     * @ORM\Column(name="name", type="string")
     */
    private $name;
    
    /**
     *
     * @var integer
     *
     * @ORM\OneToMany(targetEntity="Address", mappedBy="partner") 
     * 
     */
    private $addresses;
    
    /**
     *
     * @var string
     * 
     * 
     * @ORM\Column(name="bank", type="string")
     */
    private $bank;
    
    /**
     *
     * @var string 
     * 
     * 
     * @ORM\Column(name="iban", type="string")
     */
    private $iban;
    
    /**
     *
     * @var \DateTime 
     * 
     * 
     * @ORM\Column(name="datUpd", type="datetime")
     */
    private $datUpd;
    
    /**
     *
     * @var \DateTime 
     * 
     * 
     * @ORM\Column(name="datCre", type="datetime")
     */
    private $datCre;
    
    
    
    
    
    
}
