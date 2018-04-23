<?php

namespace BackendBundle\Entity;

/**
 * Searchhistory
 */
class Searchhistory
{
    /**
     * @var integer
     */
    private $searchhistoryid;

    /**
     * @var \DateTime
     */
    private $moment = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     */
    private $searchedtext;

    /**
     * @var boolean
     */
    private $active;

    /**
     * @var \BackendBundle\Entity\User
     */
    private $userid;


    /**
     * Get searchhistoryid
     *
     * @return integer
     */
    public function getSearchhistoryid()
    {
        return $this->searchhistoryid;
    }

    /**
     * Set moment
     *
     * @param \DateTime $moment
     *
     * @return Searchhistory
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
     * Set searchedtext
     *
     * @param string $searchedtext
     *
     * @return Searchhistory
     */
    public function setSearchedtext($searchedtext)
    {
        $this->searchedtext = $searchedtext;

        return $this;
    }

    /**
     * Get searchedtext
     *
     * @return string
     */
    public function getSearchedtext()
    {
        return $this->searchedtext;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Searchhistory
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
     * Set userid
     *
     * @param \BackendBundle\Entity\User $userid
     *
     * @return Searchhistory
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
