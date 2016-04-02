<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Warehouse
 *
 * @ORM\Table()
 * @ORM\Entity
 * @UniqueEntity("name")
 * @ORM\HasLifecycleCallbacks()
 *
 */
class Warehouse
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
        /**
         * @var string
         *
         * @ORM\Column(name="address", type="string")
         *
         */
        private $address;

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
         * @inheritDoc
         */
        public function __toString()
        {
                return $this->name;
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
         * @return Warehouse
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
         * Set address
         *
         * @param string address
         *
         * @return Warehouse
         */
        public function setAddress($address)
        {
                $this->address = $address;
                return $this;
        }
        /**
         * Get address
         *
         * @return string
         */
        public function getAddress()
        {
                return $this->address;
        }

        /**
         * Set datCre
         * @ORM\PrePersist
         * @param \DateTime $datCre
         *
         * @return FeatureName
         */
        public function setDatCre()
        {
                $this->datCre = new \Datetime();
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
         * @return FeatureName
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
}