<?php

namespace BackendBundle\Entity;

/**
 * Announcement
 */
class Announcement
{
    /**
     * @var integer
     */
    private $announcementid;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $userid;

    /**
     * @var \DateTime
     */
    private $publicationdate = 'CURRENT_TIMESTAMP';

    /**
     * @var boolean
     */
    private $active = '1';

    /**
     * @var boolean
     */
    private $modified = '0';

    /**
     * @var \BackendBundle\Entity\Category
     */
    private $categoryid;


    /**
     * Get announcementid
     *
     * @return integer
     */
    public function getAnnouncementid()
    {
        return $this->announcementid;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Announcement
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
     *
     * @return Announcement
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
     * Set userid
     *
     * @param string $userid
     *
     * @return Announcement
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid
     *
     * @return string
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set publicationdate
     *
     * @param \DateTime $publicationdate
     *
     * @return Announcement
     */
    public function setPublicationdate($publicationdate)
    {
        $this->publicationdate = $publicationdate;

        return $this;
    }

    /**
     * Get publicationdate
     *
     * @return \DateTime
     */
    public function getPublicationdate()
    {
        return $this->publicationdate;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Announcement
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
     * Set modified
     *
     * @param boolean $modified
     *
     * @return Announcement
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return boolean
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Set categoryid
     *
     * @param \BackendBundle\Entity\Category $categoryid
     *
     * @return Announcement
     */
    public function setCategoryid(\BackendBundle\Entity\Category $categoryid = null)
    {
        $this->categoryid = $categoryid;

        return $this;
    }

    /**
     * Get categoryid
     *
     * @return \BackendBundle\Entity\Category
     */
    public function getCategoryid()
    {
        return $this->categoryid;
    }
    /**
     * @var string
     */
    private $position;


    /**
     * Set position
     *
     * @param string $position
     *
     * @return Announcement
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    public function __toString()
{
    return strval( $this->getAnnouncementid() );
}
    /**
     * @var \BackendBundle\Entity\Playerposition
     */
    private $playerpositionid;

    /**
     * @var \BackendBundle\Entity\Role
     */
    private $searchedroleid;


    /**
     * Set playerpositionid
     *
     * @param \BackendBundle\Entity\Playerposition $playerpositionid
     *
     * @return Announcement
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

    /**
     * Set searchedroleid
     *
     * @param \BackendBundle\Entity\Role $searchedroleid
     *
     * @return Announcement
     */
    public function setSearchedroleid(\BackendBundle\Entity\Role $searchedroleid = null)
    {
        $this->searchedroleid = $searchedroleid;

        return $this;
    }

    /**
     * Get searchedroleid
     *
     * @return \BackendBundle\Entity\Role
     */
    public function getSearchedroleid()
    {
        return $this->searchedroleid;
    }
    /**
     * @var string
     */
    private $photo;


    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Announcement
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }
}
