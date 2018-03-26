<?php

namespace BackendBundle\Entity;

/**
 * Requestedannouncement
 */
class Requestedannouncement
{
    /**
     * @var integer
     */
    private $requestedannouncementid;

    /**
     * @var boolean
     */
    private $requested;

    /**
     * @var \DateTime
     */
    private $moment = 'CURRENT_TIMESTAMP';

    /**
     * @var boolean
     */
    private $active;

    /**
     * @var \BackendBundle\Entity\Announcement
     */
    private $announcementid;

    /**
     * @var \BackendBundle\Entity\User
     */
    private $userid;


    /**
     * Get requestedannouncementid
     *
     * @return integer
     */
    public function getRequestedannouncementid()
    {
        return $this->requestedannouncementid;
    }

    /**
     * Set requested
     *
     * @param boolean $requested
     *
     * @return Requestedannouncement
     */
    public function setRequested($requested)
    {
        $this->requested = $requested;

        return $this;
    }

    /**
     * Get requested
     *
     * @return boolean
     */
    public function getRequested()
    {
        return $this->requested;
    }

    /**
     * Set moment
     *
     * @param \DateTime $moment
     *
     * @return Requestedannouncement
     */
    public function setMoment($moment)
    {
        $this->moment = $moment;

        return $this;
    }

    /**
     * Get moment
     *
     * @return \DateTime
     */
    public function getMoment()
    {
        return $this->moment;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Requestedannouncement
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
     * Set announcementid
     *
     * @param \BackendBundle\Entity\Announcement $announcementid
     *
     * @return Requestedannouncement
     */
    public function setAnnouncementid(\BackendBundle\Entity\Announcement $announcementid = null)
    {
        $this->announcementid = $announcementid;

        return $this;
    }

    /**
     * Get announcementid
     *
     * @return \BackendBundle\Entity\Announcement
     */
    public function getAnnouncementid()
    {
        return $this->announcementid;
    }

    /**
     * Set userid
     *
     * @param \BackendBundle\Entity\User $userid
     *
     * @return Requestedannouncement
     */
    public function setUserid(\BackendBundle\Entity\User $userid = null)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid
     *
     * @return \BackendBundle\Entity\User
     */
    public function getUserid()
    {
        return $this->userid;
    }
}

