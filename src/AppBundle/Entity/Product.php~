<?php
//@ORM\Entity 
namespace AppBundle\Entity;
 
use Doctrine\ORM\Mapping as ORM;
 
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
 
/**
 * Product
 * 
 * @ORM\Entity
 * @ORM\Table(name="product")
 * 
 * @UniqueEntity("nume")
 *  
 */
class Product
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
     * @ORM\Column(name="nume", type="string")
     * 
     */
    private $nume;     
    
    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="products")
     */
    private $categories;
    
    /**
     * @ORM\ManyToMany(targetEntity="Feature", inversedBy="products")
     */
    private $features;
    
    /**
     * 
     * @ORM\OneToMany(targetEntity="ProductWarehouse", mappedBy="product")
     * 
     */
    private $productWarehouses;  
    
    /**
     * @var string
     * 
     * @ORM\Column(name="manufacturer", type="string")
     */
    private $manufacturer;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="reference", type="string")
     */
    private $reference;
    
    /**
     * @var float
     * 
     * @ORM\Column(name="sale_price", type="float")
     */
    private $salePrice;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="ean", type="string")
     */
    private $ean;
    
    /**
     * @ORM\ManyToMany(targetEntity="ProductImage", mappedBy="products")
     * 
     */
    private $images;
    
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nume
     *
     * @param string $nume
     *
     * @return Product
     */
    public function setNume($nume)
    {
        $this->nume = $nume;

        return $this;
    }

    /**
     * Get nume
     *
     * @return string
     */
    public function getNume()
    {
        return $this->nume;
    }

    /**
     * Set datCre
     *
     * @param \DateTime $datCre
     *
     * @return Product
     */
    public function setDatCre($datCre)
    {
        $this->datCre = $datCre;

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
     * @param \DateTime $datUpd
     *
     * @return Product
     */
    public function setDatUpd($datUpd)
    {
        $this->datUpd = $datUpd;

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
}
