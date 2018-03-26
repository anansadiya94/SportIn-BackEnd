<?php

namespace BackendBundle\Entity;

/**
 * User
 */
class User
{
    /**
     * @var integer
     */
    private $userid;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $surname1;

    /**
     * @var string
     */
    private $surname2;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $password;

    /**
     * @var boolean
     */
    private $active;

    /**
     * @var \DateTime
     */
    private $birthdate;

    /**
     * @var integer
     */
    private $age;

    /**
     * @var string
     */
    private $profilephoto;

    /**
     * @var string
     */
    private $height;

    /**
     * @var string
     */
    private $weight;

    /**
     * @var string
     */
    private $bio;

    /**
     * @var \BackendBundle\Entity\Country
     */
    private $countryid;

    /**
     * @var \BackendBundle\Entity\Population
     */
    private $populationid;

    /**
     * @var \BackendBundle\Entity\Role
     */
    private $roleid;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $clubid;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $playerpositionid;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->clubid = new \Doctrine\Common\Collections\ArrayCollection();
        $this->playerpositionid = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set surname1
     *
     * @param string $surname1
     *
     * @return User
     */
    public function setSurname1($surname1)
    {
        $this->surname1 = $surname1;

        return $this;
    }

    /**
     * Get surname1
     *
     * @return string
     */
    public function getSurname1()
    {
        return $this->surname1;
    }

    /**
     * Set surname2
     *
     * @param string $surname2
     *
     * @return User
     */
    public function setSurname2($surname2)
    {
        $this->surname2 = $surname2;

        return $this;
    }

    /**
     * Get surname2
     *
     * @return string
     */
    public function getSurname2()
    {
        return $this->surname2;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return User
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
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return User
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return User
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set profilephoto
     *
     * @param string $profilephoto
     *
     * @return User
     */
    public function setProfilephoto($profilephoto)
    {
        $this->profilephoto = $profilephoto;

        return $this;
    }

    /**
     * Get profilephoto
     *
     * @return string
     */
    public function getProfilephoto()
    {
        return $this->profilephoto;
    }

    /**
     * Set height
     *
     * @param string $height
     *
     * @return User
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return string
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set weight
     *
     * @param string $weight
     *
     * @return User
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set bio
     *
     * @param string $bio
     *
     * @return User
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get bio
     *
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set countryid
     *
     * @param \BackendBundle\Entity\Country $countryid
     *
     * @return User
     */
    public function setCountryid(\BackendBundle\Entity\Country $countryid = null)
    {
        $this->countryid = $countryid;

        return $this;
    }

    /**
     * Get countryid
     *
     * @return \BackendBundle\Entity\Country
     */
    public function getCountryid()
    {
        return $this->countryid;
    }

    /**
     * Set populationid
     *
     * @param \BackendBundle\Entity\Population $populationid
     *
     * @return User
     */
    public function setPopulationid(\BackendBundle\Entity\Population $populationid = null)
    {
        $this->populationid = $populationid;

        return $this;
    }

    /**
     * Get populationid
     *
     * @return \BackendBundle\Entity\Population
     */
    public function getPopulationid()
    {
        return $this->populationid;
    }

    /**
     * Set roleid
     *
     * @param \BackendBundle\Entity\Role $roleid
     *
     * @return User
     */
    public function setRoleid(\BackendBundle\Entity\Role $roleid = null)
    {
        $this->roleid = $roleid;

        return $this;
    }

    /**
     * Get roleid
     *
     * @return \BackendBundle\Entity\Role
     */
    public function getRoleid()
    {
        return $this->roleid;
    }

    /**
     * Add clubid
     *
     * @param \BackendBundle\Entity\Club $clubid
     *
     * @return User
     */
    public function addClubid(\BackendBundle\Entity\Club $clubid)
    {
        $this->clubid[] = $clubid;

        return $this;
    }

    /**
     * Remove clubid
     *
     * @param \BackendBundle\Entity\Club $clubid
     */
    public function removeClubid(\BackendBundle\Entity\Club $clubid)
    {
        $this->clubid->removeElement($clubid);
    }

    /**
     * Get clubid
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClubid()
    {
        return $this->clubid;
    }

    /**
     * Add playerpositionid
     *
     * @param \BackendBundle\Entity\Playerposition $playerpositionid
     *
     * @return User
     */
    public function addPlayerpositionid(\BackendBundle\Entity\Playerposition $playerpositionid)
    {
        $this->playerpositionid[] = $playerpositionid;

        return $this;
    }

    /**
     * Remove playerpositionid
     *
     * @param \BackendBundle\Entity\Playerposition $playerpositionid
     */
    public function removePlayerpositionid(\BackendBundle\Entity\Playerposition $playerpositionid)
    {
        $this->playerpositionid->removeElement($playerpositionid);
    }

    /**
     * Get playerpositionid
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlayerpositionid()
    {
        return $this->playerpositionid;
    }
}

