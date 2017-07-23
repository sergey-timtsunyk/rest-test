<?php

namespace PaymentBundle\Entity;

/**
 * Transaction
 */
class Transaction
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var double
     */
    private $amount;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var \PaymentBundle\Entity\Customer
     */
    private $customer;

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
     * Set amount
     *
     * @param float $amount
     *
     * @return Transaction
     */
    public function setAmount(float $amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate() : \DateTime
    {
        return $this->date;
    }

    /**
     * Set customer
     *
     * @param \PaymentBundle\Entity\Customer $customer
     *
     * @return Transaction
     */
    public function setCustomer(Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \PaymentBundle\Entity\Customer
     */
    public function getCustomer() : Customer
    {
        return $this->customer;
    }

    /**
     * Set date
     *
     * @return Transaction
     */
    public function setDatePrePersist()
    {
        $this->date = new \DateTime();

        return $this;
    }
}

