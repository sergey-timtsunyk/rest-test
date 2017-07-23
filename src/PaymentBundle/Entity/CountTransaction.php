<?php

namespace PaymentBundle\Entity;

/**
 * CountTransaction
 */
class CountTransaction
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var float
     */
    private $sum;

    /**
     * @var \DateTime
     */
    private $date;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set sum
     *
     * @param float $sum
     */
    public function setSum(float $sum)
    {
        $this->sum = $sum;
    }

    /**
     * Get sum
     *
     * @return float
     */
    public function getSum() : float
    {
        return $this->sum;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return CountTransaction
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
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
}

