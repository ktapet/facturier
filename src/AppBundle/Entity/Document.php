<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Document
 *
 * @ORM\Table()
 * @ORM\Entity
 * @UniqueEntity("docNumber")
 * @ORM\HasLifecycleCallbacks()
 */
class Document
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
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Partner")
     * @ORM\JoinColumn(name="partner_id", referencedColumnName="id")
     */
    private $partner;  
    
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="DocType")
     * @ORM\JoinColumn(name="doctype_id", referencedColumnName="id")
     */
    private $docType;     
    
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="PaymentType")
     * @ORM\JoinColumn(name="paymenttype_id", referencedColumnName="id")
     */
    private $paymentType;       
    
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;     
    
    /**
     * @var integer
     *
     * @ORM\OneToMany(targetEntity="DocumentLine", mappedBy="document")
     * 
     */
    private $documentLines;  
    
     /**
     * @var string
     *
     * @ORM\Column(name="doc_number", type="string")
     */
    private $docNumber;   
    
    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="DocStatus")
     * @ORM\JoinColumn(name="docstatus_id", referencedColumnName="id")
     */
    private $docStatus;       
    
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
