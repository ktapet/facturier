<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
 
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 *  Address
 * 
 * @ORM\Table(name="address")
 * @ORM\Entity
 * @UniqueEntity("nume")
 */
class Address {
    
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
     * @ORM\Column(name="alias", type="string")
     */
    private $alias;
    
    /**
     *
     * @var string
     * 
     * 
     * @ORM\Column(name="street", type="string")
     */
    private $street;
    
    /**
     *
     * @var integer 
     * 
     * 
     * @ORM\Column(name="no", type="integer")
     */
    private $no;
    
    /**
     *
     * @var string 
     * 
     * 
     * @ORM\Column(name="city", type="string")
     */
    private $city;
    
    /**
     *
     * @var string 
     * 
     * 
     * @ORM\Column(name="country", type="string")
     */
    private $country;
    
    /**
     *
     * @var string 
     * 
     * 
     * @ORM\Column(name="phone", type="string")
     */
    private $phone;
    
    /**
     *
     * @var string 
     * 
     * 
     * @ORM\Column(name="email", type="string")
     */
    private $email;
    
    /**
     *
     * @var integer
     * 
     * @ORM\ManyToOne(targetEntity="Partner", inversedBy="addresses") 
     * 
     */
    private $partner;
    
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
