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
 * @ORM\HasLifecycleCallbacks()
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
     *
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
     * @ORM\Column(name="dat_upd", type="datetime")
     */
    private $datUpd;
    
    /**
     *
     * @var \DateTime  
     * 
     * 
     * @ORM\Column(name="dat_cre", type="datetime")
     */
    private $datCre;
    


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
     * Set alias
     *
     * @param string $alias
     *
     * @return Address
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set no
     *
     * @param string $no
     *
     * @return Address
     */
    public function setNo($no)
    {
        $this->no = $no;

        return $this;
    }

    /**
     * Get no
     *
     * @return string
     */
    public function getNo()
    {
        return $this->no;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Address
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Address
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Address
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
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
     * Set partner
     *
     * @param \AppBundle\Entity\Partner $partner
     *
     * @return Address
     */
    public function setPartner(\AppBundle\Entity\Partner $partner = null)
    {
        $this->partner = $partner;

        return $this;
    }

    /**
     * Get partner
     *
     * @return \AppBundle\Entity\Partner
     */
    public function getPartner()
    {
        return $this->partner;
    }


    public function __toString()
    {
        return $this->alias;
    }

}
