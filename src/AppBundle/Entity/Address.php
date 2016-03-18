<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Address
 * 
 * @ORM\Table(name="address")
 * @ORM\Entity()
 * @UniqueEntity("alias")
 */
class Address
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="alias", type="string", length=30)
     */
    private $alias;

    /**
     * @ORM\Column(name="street", type="string")
     */
    private $street;
    
    /**
     * @ORM\Column(name="no", type="string")
     */
    private $no;    
    
    /**
     * @ORM\Column(name="city", type="string")
     */
    private $city;    
    
    /**
     * @ORM\Column(name="country", type="string")
     */
    private $country;    
    
    /**
     * @ORM\Column(name="email", type="string")
     */
    private $email;
    
    /**
     * @ORM\Column(name="phone", type="string")
     */
    private $phone;    
  
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Partner", inversedBy="addresses")
     *
     */
    private $partner;   
    
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
