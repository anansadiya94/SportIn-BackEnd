<?php

namespace BackendBundle\Entity;

/**
 * Population
 */
class Population
{
    /**
     * @var integer
     */
    private $populationid;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $province;

    /**
     * @var string
     */
    private $postalcode;


    /**
     * Get populationid
     *
     * @return integer
     */
    public function getPopulationid()
    {
        return $this->populationid;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Population
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
     * Set province
     *
     * @param string $province
     *
     * @return Population
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

    /**
     * Set postalcode
     *
     * @param string $postalcode
     *
     * @return Population
     */
    public function setPostalcode($postalcode)
    {
        $this->postalcode = $postalcode;

        return $this;
    }

    /**
     * Get postalcode
     *
     * @return string
     */
    public function getPostalcode()
    {
        return $this->postalcode;
    }
}

