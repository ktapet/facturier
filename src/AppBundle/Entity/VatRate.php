<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * VatRate
 *
 * @ORM\Table()
 * @ORM\Entity
 * @UniqueEntity("code")
 * 
 */
class VatRate
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
     * @var string
     *
     * @ORM\Column(name="code", type="string")
     */
    private $code;    
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string")
     */
    private $description;    
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="rate", type="decimal", precision=16, scale=6)
     */
    private $rate;       
    
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
