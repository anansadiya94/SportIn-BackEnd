<?php

namespace BackendBundle\Entity;

/**
 * Contactperuser
 */
class Contactperuser
{
    /**
     * @var integer
     */
    private $userid;

    /**
     * @var integer
     */
    private $contactUserid;


    /**
     * Set userid
     *
     * @param integer $userid
     *
     * @return Contactperuser
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
     * Set contactUserid
     *
     * @param integer $contactUserid
     *
     * @return Contactperuser
     */
    public function setContactUserid($contactUserid)
    {
        $this->contactUserid = $contactUserid;

        return $this;
    }

    /**
     * Get contactUserid
     *
     * @return integer
     */
    public function getContactUserid()
    {
        return $this->contactUserid;
    }
}
