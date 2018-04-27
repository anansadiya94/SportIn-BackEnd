<?php

namespace BackendBundle\Entity;

/**
 * Country
 */
class Country
{
    /**
     * @var integer
     */
    private $countryid;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $noc;

    /**
     * @var string
     */
    private $flag;


    /**
     * Get countryid
     *
     * @return integer
     */
    public function getCountryid()
    {
        return $this->countryid;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Country
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
     * Set noc
     *
     * @param string $noc
     *
     * @return Country
     */
    public function setNoc($noc)
    {
        $this->noc = $noc;

        return $this;
    }

    /**
     * Get noc
     *
     * @return string
     */
    public function getNoc()
    {
        return $this->noc;
    }

    /**
     * Set flag
     *
     * @param string $flag
     *
     * @return Country
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * Get flag
     *
     * @return string
     */
    public function getFlag()
    {
        return $this->flag;
    }

     public function __toString()
{
    return strval( $this->getCountryid() );
}
}
