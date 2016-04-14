<?php
//@ORM\Entity 
namespace AppBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;

/**
 * VatRate
 * 
 * @ORM\Entity
 * @ORM\Table(name="vat_rate")
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
     * 
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="cod", type="string")
     * 
     */
    private $cod; 
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string")
     * 
     */
    private $description; 

    /**
     * @var float
     * 
     * @ORM\Column(name="rate", type="float")
     * 
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

