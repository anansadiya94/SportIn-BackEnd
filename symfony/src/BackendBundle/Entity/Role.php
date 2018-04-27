<?php

namespace BackendBundle\Entity;

/**
 * Role
 */
class Role
{
    /**
     * @var integer
     */
    private $roleid;

    /**
     * @var string
     */
    private $name;

    /**
     * @var boolean
     */
    private $active;


    /**
     * Get roleid
     *
     * @return integer
     */
    public function getRoleid()
    {
        return $this->roleid;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Role
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
     * Set active
     *
     * @param boolean $active
     *
     * @return Role
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

    public function __toString()
{
    return strval( $this->getRoleid() );
}
}
