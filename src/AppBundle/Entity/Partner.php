<?php

<<<<<<< HEAD

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
    
    
=======
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Partner
 *
 * @ORM\Table()
 * @ORM\Entity
 * @UniqueEntity("name")
 * @ORM\HasLifecycleCallbacks()
 * 
 */
class Partner
{
>>>>>>> 9717e311e57647e7024ad665475bb40f41b76fd2
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
<<<<<<< HEAD
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
    
    
    
    
    
    
=======
     */
    private $id;      
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;       
    
    /**
     * @var integer
     *
     * @ORM\OneToMany(targetEntity="Address", mappedBy="partner")
     *
     */
    private $addresses;     
    
    /**
     * @var string
     *
     * @ORM\Column(name="bank", type="string", nullable=true)
     * 
     */
    private $bank;    
    
    /**
     * @var string
     *
     * @ORM\Column(name="iban", type="string", nullable=true)
     * 
     */
    private $iban;      
    
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
     * Constructor
     */
    public function __construct()
    {
        $this->addresses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Partner
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set bank
     *
     * @param string $bank
     *
     * @return Partner
     */
    public function setBank($bank)
    {
        $this->bank = $bank;

        return $this;
    }

    /**
     * Get bank
     *
     * @return string
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * Set iban
     *
     * @param string $iban
     *
     * @return Partner
     */
    public function setIban($iban)
    {
        $this->iban = $iban;

        return $this;
    }

    /**
     * Get iban
     *
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * Set datCre
     * @ORM\PrePersist
     * @param \DateTime $datCre
     *
     * @return Partner
     */
    public function setDatCre()
    {
        $this->datCre = new \DateTime();

        return $this;
    }

    /**
     * Get datCre
     *
     * @return \DateTime
     */
    public function getDatCre()
    {
        return $this->datCre;
    }

    /**
     * Set datUpd
     *
     * @ORM\PreUpdate
     * @ORM\PrePersist
     * 
     * @param \DateTime $datUpd
     *
     * @return Partner
     */
    public function setDatUpd()
    {
        $this->datUpd = new \DateTime();

        return $this;
    }

    /**
     * Get datUpd
     *
     * @return \DateTime
     */
    public function getDatUpd()
    {
        return $this->datUpd;
    }

    /**
     * Add address
     *
     * @param \AppBundle\Entity\Address $address
     *
     * @return Partner
     */
    public function addAddress(\AppBundle\Entity\Address $address)
    {
        $this->addresses[] = $address;

        return $this;
    }

    /**
     * Remove address
     *
     * @param \AppBundle\Entity\Address $address
     */
    public function removeAddress(\AppBundle\Entity\Address $address)
    {
        $this->addresses->removeElement($address);
    }

    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }
>>>>>>> 9717e311e57647e7024ad665475bb40f41b76fd2
}
