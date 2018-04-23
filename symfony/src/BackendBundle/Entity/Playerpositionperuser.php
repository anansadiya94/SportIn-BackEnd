<?php

namespace BackendBundle\Entity;

/**
 * Playerpositionperuser
 */
class Playerpositionperuser
{
    /**
     * @var integer
     */
    private $userid;

    /**
     * @var boolean
     */
    private $prefered;

    /**
     * @var boolean
     */
    private $active = '1';

    /**
     * @var \BackendBundle\Entity\Playerposition
     */
    private $playerpositionid;


    /**
     * Set userid
     *
     * @param integer $userid
     *
     * @return Playerpositionperuser
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid
     *
     * @return integer
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set prefered
     *
     * @param boolean $prefered
     *
     * @return Playerpositionperuser
     */
    public function setPrefered($prefered)
    {
        $this->prefered = $prefered;

        return $this;
    }

    /**
     * Get prefered
     *
     * @return boolean
     */
    public function getPrefered()
    {
        return $this->prefered;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Playerpositionperuser
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
     * Set playerpositionid
     *
     * @param \BackendBundle\Entity\Playerposition $playerpositionid
     *
     * @return Playerpositionperuser
     */
    public function setPlayerpositionid(\BackendBundle\Entity\Playerposition $playerpositionid = null)
    {
        $this->playerpositionid = $playerpositionid;

        return $this;
    }

    /**
     * Get playerpositionid
     *
     * @return \BackendBundle\Entity\Playerposition
     */
    public function getPlayerpositionid()
    {
        return $this->playerpositionid;
    }
}
