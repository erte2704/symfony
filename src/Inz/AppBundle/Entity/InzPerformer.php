<?php

namespace Inz\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InzPerformer
 *
 * @ORM\Table(name="inz_performer")
 * @ORM\Entity
 */
class InzPerformer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="company", type="integer", nullable=true)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="company_name", type="string", length=45, nullable=true)
     */
    private $companyName;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=45, nullable=true)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=45, nullable=true)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \InzUser
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="InzUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id")
     * })
     */
    private $id;



    /**
     * Set company
     *
     * @param integer $company
     * @return InzPerformer
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return integer 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set companyName
     *
     * @param string $companyName
     * @return InzPerformer
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string 
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return InzPerformer
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
     * Set surname
     *
     * @param string $surname
     * @return InzPerformer
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return InzPerformer
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return InzPerformer
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
     * Set id
     *
     * @param \Inz\AppBundle\Entity\InzUser $id
     * @return InzPerformer
     */
    public function setId(\Inz\AppBundle\Entity\InzUser $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return \Inz\AppBundle\Entity\InzUser 
     */
    public function getId()
    {
        return $this->id;
    }
}
