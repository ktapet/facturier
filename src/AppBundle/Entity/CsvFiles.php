<?php

namespace AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * CsvFiles
 *
 * @ORM\Table(name="csv_files")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class CsvFiles
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     * 
     * 
     */
    private $name;    
    
    /**
     * @ORM\Column(name="tip", type="string", length=255)
     * 
     * 
     */
    private $tip;      
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_used", type="boolean", nullable=true)
     */
    private $isUsed;    

    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dat_cre", type="datetime")
     */
    private $datCre; 
    
     /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $path;

    public function getAbsolutPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadPath().'/'.$this->path;
    }

        public function getUploadRootDir()
        {
            return __DIR__.'/../../../../web/uploads/images/'.$this->getUploadDir();
        }

        public function getUploadDir()
        {
            return 'uploads/docucuments';
        }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getTip()
    {
        return $this->tip;
    }

    /**
     * @param mixed $tip
     */
    public function setTip($tip)
    {
        $this->tip = $tip;
    }

    /**
     * @return boolean
     */
    public function isIsUsed()
    {
        return $this->isUsed;
    }

    /**
     * @param boolean $isUsed
     */
    public function setIsUsed($isUsed)
    {
        $this->isUsed = $isUsed;
    }

    /**
     * @return \DateTime
     */
    public function getDatCre()
    {
        return $this->datCre;
    }

    /**
     * @param \DateTime $datCre
     *
     * @ORM\PrePersist()
     */
    public function setDatCre()
    {
        $this->datCre = new \DateTime();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }


}
