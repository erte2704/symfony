<?php

namespace Inz\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InzOffer
 *
 * @ORM\Table(name="inz_offer", indexes={@ORM\Index(name="fk_inz_offer_inz_category_idx", columns={"category"}), @ORM\Index(name="fk_inz_offer_inz_user1_idx", columns={"author"})})
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255, nullable=true)
     */
    private $location;

    /**
     * @var integer
     *
     * @ORM\Column(name="days", type="integer", nullable=true)
     */
    private $days;

    /**
     * @var integer
     *
     * @ORM\Column(name="visit", type="integer", nullable=true)
     */
    private $visit;

    /**
     * @var string
     *
     * @ORM\Column(name="tags", type="string", length=255, nullable=true)
     */
    private $tags;

    /**
     * @var \InzCategory
     *
     * @ORM\ManyToOne(targetEntity="InzCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category", referencedColumnName="id")
     * })
     */
    private $category;

    /**
     * @var \InzUser
     *
     * @ORM\ManyToOne(targetEntity="InzUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="author", referencedColumnName="id")
     * })
     */
    private $author;



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
     * Set title
     *
     * @param string $title
     * @return InzOffer
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
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
     * Set date
     *
     * @param \DateTime $date
     * @return InzOffer
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
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
     * Set days
     *
     * @param integer $days
     * @return InzOffer
     */
    public function setDays($days)
    {
        $this->days = $days;

        return $this;
    }

    /**
     * Get days
     *
     * @return integer 
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * Set visit
     *
     * @param integer $visit
     * @return InzOffer
     */
    public function setVisit($visit)
    {
        $this->visit = $visit;

        return $this;
    }

    /**
     * Get visit
     *
     * @return integer 
     */
    public function getVisit()
    {
        return $this->visit;
    }

    /**
     * Set tags
     *
     * @param string $tags
     * @return InzOffer
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set category
     *
     * @param \Inz\AppBundle\Entity\InzCategory $category
     * @return InzOffer
     */
    public function setCategory(\Inz\AppBundle\Entity\InzCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Inz\AppBundle\Entity\InzCategory 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set author
     *
     * @param \Inz\AppBundle\Entity\InzUser $author
     * @return InzOffer
     */
    public function setAuthor(\Inz\AppBundle\Entity\InzUser $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Inz\AppBundle\Entity\InzUser 
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
