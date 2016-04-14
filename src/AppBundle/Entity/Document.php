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
     * @ORM\OneToMany(targetEntity="DocumentLine", mappedBy="document",cascade={"persist"})
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
     *
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->documentLines = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set docNumber
     *
     * @param string $docNumber
     *
     * @return Document
     */
    public function setDocNumber($docNumber)
    {
        $this->docNumber = $docNumber;
        return $this;
    }
    /**
     * Get docNumber
     *
     * @return string
     */
    public function getDocNumber()
    {
        return $this->docNumber;
    }
    /**
     * Set datCre
     * @ORM\PrePersist
     * @param \DateTime $datCre
     *
     * @return Document
     */
    public function setDatCre($datCre)
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
     * @ORM\PreUpdate
     * @ORM\PrePersist
     * @param \DateTime $datUpd
     *
     * @return Document
     */
    public function setDatUpd($datUpd)
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
     * @return Document
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
    /**
     * Set docType
     *
     * @param \AppBundle\Entity\DocType $docType
     *
     * @return Document
     */
    public function setDocType(\AppBundle\Entity\DocType $docType = null)
    {
        $this->docType = $docType;
        return $this;
    }
    /**
     * Get docType
     *
     * @return \AppBundle\Entity\DocType
     */
    public function getDocType()
    {
        return $this->docType;
    }
    /**
     * Set paymentType
     *
     * @param \AppBundle\Entity\PaymentType $paymentType
     *
     * @return Document
     */
    public function setPaymentType(\AppBundle\Entity\PaymentType $paymentType = null)
    {
        $this->paymentType = $paymentType;
        return $this;
    }
    /**
     * Get paymentType
     *
     * @return \AppBundle\Entity\PaymentType
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }
    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Document
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;
        return $this;
    }
    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Add documentLine
     *
     * @param \AppBundle\Entity\DocumentLine $documentLine
     *
     * @return Document
     */
    public function addDocumentLine(\AppBundle\Entity\DocumentLine $documentLine)
    {
        $documentLine->setDocument($this);

        $this->documentLines->add($documentLine);

    }
    /**
     * Remove documentLine
     *
     * @param \AppBundle\Entity\DocumentLine $documentLine
     */
    public function removeDocumentLine(\AppBundle\Entity\DocumentLine $documentLine)
    {
        $this->documentLines->removeElement($documentLine);
    }
    /**
     * Get documentLines
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocumentLines()
    {
        return $this->documentLines;
    }
    /**
     * Set docStatus
     *
     * @param \AppBundle\Entity\DocStatus $docStatus
     *
     * @return Document
     */
    public function setDocStatus(\AppBundle\Entity\DocStatus $docStatus = null)
    {
        $this->docStatus = $docStatus;
        return $this;
    }
    /**
     * Get docStatus
     *
     * @return \AppBundle\Entity\DocStatus
     */
    public function getDocStatus()
    {
        return $this->docStatus;
    }
}