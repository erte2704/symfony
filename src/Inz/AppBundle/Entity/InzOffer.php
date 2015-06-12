<?php

namespace Inz\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InzOffer
 *
 * @ORM\Table(name="inz_offer", indexes={@ORM\Index(name="fk_inz_offer_performance_inz_performer1_idx", columns={"performer"}), @ORM\Index(name="fk_inz_offer_performance_inz_offer1_idx", columns={"ad"})})
 * @ORM\Entity
 */
class InzOffer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer", nullable=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @var integer
     *
     * @ORM\Column(name="accept", type="integer", nullable=true)
     */
    private $accept;

    /**
     * @var integer
     *
     * @ORM\Column(name="completed", type="integer", nullable=true)
     */
    private $completed;

    /**
     * @var \InzAd
     *
     * @ORM\ManyToOne(targetEntity="InzAd")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ad", referencedColumnName="id")
     * })
     */
    private $ad;

    /**
     * @var \InzPerformer
     *
     * @ORM\ManyToOne(targetEntity="InzPerformer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="performer", referencedColumnName="id")
     * })
     */
    private $performer;



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
     * Set price
     *
     * @param integer $price
     * @return InzOffer
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return InzOffer
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return InzOffer
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set accept
     *
     * @param integer $accept
     * @return InzOffer
     */
    public function setAccept($accept)
    {
        $this->accept = $accept;

        return $this;
    }

    /**
     * Get accept
     *
     * @return integer 
     */
    public function getAccept()
    {
        return $this->accept;
    }

    /**
     * Set completed
     *
     * @param integer $completed
     * @return InzOffer
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;

        return $this;
    }

    /**
     * Get completed
     *
     * @return integer 
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * Set ad
     *
     * @param \Inz\AppBundle\Entity\InzAd $ad
     * @return InzOffer
     */
    public function setAd(\Inz\AppBundle\Entity\InzAd $ad = null)
    {
        $this->ad = $ad;

        return $this;
    }

    /**
     * Get ad
     *
     * @return \Inz\AppBundle\Entity\InzAd 
     */
    public function getAd()
    {
        return $this->ad;
    }

    /**
     * Set performer
     *
     * @param \Inz\AppBundle\Entity\InzPerformer $performer
     * @return InzOffer
     */
    public function setPerformer(\Inz\AppBundle\Entity\InzPerformer $performer = null)
    {
        $this->performer = $performer;

        return $this;
    }

    /**
     * Get performer
     *
     * @return \Inz\AppBundle\Entity\InzPerformer 
     */
    public function getPerformer()
    {
        return $this->performer;
    }
}
