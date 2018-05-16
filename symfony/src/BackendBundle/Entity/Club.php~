<?php

namespace BackendBundle\Entity;

/**
 * Club
 */
class Club
{
    /**
     * @var integer
     */
    private $clubid;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $shield;

    /**
     * @var string
     */
    private $initials;

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
     * Get clubid
     *
     * @return integer
     */
    public function getClubid()
    {
        return $this->clubid;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Club
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
     * Set shield
     *
     * @param string $shield
     *
     * @return Club
     */
    public function setShield($shield)
    {
        $this->shield = $shield;

        return $this;
    }

    /**
     * Get shield
     *
     * @return string
     */
    public function getShield()
    {
        return $this->shield;
    }

    /**
     * Set initials
     *
     * @param string $initials
     *
     * @return Club
     */
    public function setInitials($initials)
    {
        $this->initials = $initials;

        return $this;
    }

    /**
     * Get initials
     *
     * @return string
     */
    public function getInitials()
    {
        return $this->initials;
    }

    /**
     * Add userid
     *
     * @param \BackendBundle\Entity\User $userid
     *
     * @return Club
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
    /**
     * @var string
     */
    private $location;

    /**
     * @var string
     */
    private $province;


    /**
     * Set location
     *
     * @param string $location
     *
     * @return Club
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
     * Set province
     *
     * @param string $province
     *
     * @return Club
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
    }

    public function __toString()
    {
        return strval( $this->getClubid() );
    }

}
