<?php
//@ORM\Entity 
namespace AppBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;

/**
 * DocType
 * 
 * @ORM\Entity
 * @ORM\Table(name="doc_type")
 *  
 */
class DocType
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
     * @ORM\Column(name="name", type="string")
     * 
     */
    private $name;     
    
    /*
     * @var integer
     * @ORM\Column(name="direction", type="integer")
     */
    private $direction;
    
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