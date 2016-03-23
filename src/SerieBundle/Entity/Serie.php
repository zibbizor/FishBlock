<?php

namespace SerieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Serie
 *
 * @ORM\Table(name="serie")
 * @ORM\Entity(repositoryClass="SerieBundle\Repository\SerieRepository")
 */
class Serie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var text
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="cover", type="string", length=255, nullable=true)
     */
    private $cover;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creation_date", type="date")
     */
    private $creationDate;

    /**
     * @var \DateTime
     * @ORM\Column(name="tvdb_timestamp", type="datetime", nullable=true)
     * @ORM\Version
     */
    private $lastTVDBUpdate;

    /**
     * @var bool
     *
     * @ORM\Column(name="admin_approved", type="boolean")
     */
    private $adminApproved;

    /**
     * @var int
     *
     * @ORM\Column(name="state", type="smallint")
     */
    private $state;

    /**
     * @ORM\OneToMany(targetEntity="Season", mappedBy="serie", cascade={"persist", "remove"})
     */
    private $seasons;


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
     * @return Serie
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
     * Set cover
     *
     * @param string $cover
     * @return Serie
     */
    public function setCover($cover)
    {
        $this->cover = $cover;

        return $this;
    }

    /**
     * Get cover
     *
     * @return string 
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     * @return Serie
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime 
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }
    
    /**
     * Set adminApproved
     *
     * @param boolean $adminApproved
     * @return Serie
     */
    public function setAdminApproved($adminApproved)
    {
        $this->adminApproved = $adminApproved;

        return $this;
    }

    /**
     * Get adminApproved
     *
     * @return boolean 
     */
    public function getAdminApproved()
    {
        return $this->adminApproved;
    }

    /**
     * Set state
     *
     * @param integer $state
     * @return Serie
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return integer 
     */
    public function getState()
    {
        return $this->state;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->seasons = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add seasons
     *
     * @param \SerieBundle\Entity\Season $seasons
     * @return Serie
     */
    public function addSeason(\SerieBundle\Entity\Season $seasons)
    {
        $this->seasons[] = $seasons;

        return $this;
    }

    /**
     * Remove seasons
     *
     * @param \SerieBundle\Entity\Season $seasons
     */
    public function removeSeason(\SerieBundle\Entity\Season $seasons)
    {
        $this->seasons->removeElement($seasons);
    }

    /**
     * Get seasons
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSeasons()
    {
        return $this->seasons;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Serie
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
     * Set lastTVDBUpdate
     *
     * @param \DateTime $lastTVDBUpdate
     * @return Serie
     */
    public function setLastTVDBUpdate($lastTVDBUpdate)
    {
        $this->lastTVDBUpdate = $lastTVDBUpdate;

        return $this;
    }

    /**
     * Get lastTVDBUpdate
     *
     * @return \DateTime 
     */
    public function getLastTVDBUpdate()
    {
        return $this->lastTVDBUpdate;
    }
}
