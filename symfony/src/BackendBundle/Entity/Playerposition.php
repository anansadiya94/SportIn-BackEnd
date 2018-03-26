<?php

namespace BackendBundle\Entity;

/**
 * Playerposition
 */
class Playerposition
{
    /**
     * @var integer
     */
    private $playerpositionid;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $abbrev;

    /**
     * @var boolean
     */
    private $active;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $userid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userid = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get playerpositionid
     *
     * @return integer
     */
    public function getPlayerpositionid()
    {
        return $this->playerpositionid;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Playerposition
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
     * Set abbrev
     *
     * @param string $abbrev
     *
     * @return Playerposition
     */
    public function setAbbrev($abbrev)
    {
        $this->abbrev = $abbrev;

        return $this;
    }

    /**
     * Get abbrev
     *
     * @return string
     */
    public function getAbbrev()
    {
        return $this->abbrev;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Playerposition
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Add userid
     *
     * @param \BackendBundle\Entity\User $userid
     *
     * @return Playerposition
     */
    public function addUserid(\BackendBundle\Entity\User $userid)
    {
        $this->userid[] = $userid;

        return $this;
    }

    /**
     * Remove userid
     *
     * @param \BackendBundle\Entity\User $userid
     */
    public function removeUserid(\BackendBundle\Entity\User $userid)
    {
        $this->userid->removeElement($userid);
    }

    /**
     * Get userid
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserid()
    {
        return $this->userid;
    }
}

