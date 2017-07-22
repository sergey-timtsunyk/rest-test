<?php

namespace PaymentBundle\Entity;

/**
 * Customer
 */
class Customer
{
    /**
     * @var integer
     *
     * @TODO remove to UUID
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $cnp;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Customer
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Set cnp
     *
     * @param string $cnp
     *
     * @return Customer
     */
    public function setCnp(string $cnp)
    {
        $this->cnp = $cnp;

        return $this;
    }

    /**
     * Get cnp
     *
     * @return string
     */
    public function getCnp() : string
    {
        return $this->cnp;
    }
}

