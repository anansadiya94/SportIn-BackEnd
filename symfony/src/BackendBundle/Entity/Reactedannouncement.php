<?php

namespace BackendBundle\Entity;

/**
 * Reactedannouncement
 */
class Reactedannouncement
{
    /**
     * @var integer
     */
    private $reactedannouncementid;

    /**
     * @var boolean
     */
    private $liked;

    /**
     * @var boolean
     */
    private $interested;

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
     * Get reactedannouncementid
     *
     * @return integer
     */
    public function getReactedannouncementid()
    {
        return $this->reactedannouncementid;
    }

    /**
     * Set liked
     *
     * @param boolean $liked
     *
     * @return Reactedannouncement
     */
    public function setLiked($liked)
    {
        $this->liked = $liked;

        return $this;
    }

    /**
     * Get liked
     *
     * @return boolean
     */
    public function getLiked()
    {
        return $this->liked;
    }

    /**
     * Set interested
     *
     * @param boolean $interested
     *
     * @return Reactedannouncement
     */
    public function setInterested($interested)
    {
        $this->interested = $interested;

        return $this;
    }

    /**
     * Get interested
     *
     * @return boolean
     */
    public function getInterested()
    {
        return $this->interested;
    }

    /**
     * Set moment
     *
     * @param \DateTime $moment
     *
     * @return Reactedannouncement
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
     * @return Reactedannouncement
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
     * @return Reactedannouncement
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
     * @return Reactedannouncement
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
