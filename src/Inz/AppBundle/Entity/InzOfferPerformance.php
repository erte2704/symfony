<?php

namespace Inz\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InzOfferPerformance
 *
 * @ORM\Table(name="inz_offer_performance")
 * @ORM\Entity
 */
class InzOfferPerformance
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
     * @ORM\Column(name="location", type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @var integer
     *
     * @ORM\Column(name="performer", type="integer", nullable=true)
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
     * @return InzOfferPerformance
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
     * Set location
     *
     * @param string $location
     * @return InzOfferPerformance
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
     * Set performer
     *
     * @param integer $performer
     * @return InzOfferPerformance
     */
    public function setPerformer($performer)
    {
        $this->performer = $performer;

        return $this;
    }

    /**
     * Get performer
     *
     * @return integer 
     */
    public function getPerformer()
    {
        return $this->performer;
    }
}
