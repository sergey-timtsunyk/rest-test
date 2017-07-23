<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 23.07.17
 * Time: 0:37
 */

namespace RestBundle\Representation\Response;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use RestBundle\Representation\RepresentationInterface;

class TransactionsRepresentation implements RepresentationInterface
{
    /**
     * @var integer
     *
     * @Type("integer")
     * @SerializedName("transactionId")
     */
    private $transactionId;

    /**
     * @var float
     *
     * @Type("float")
     */
    private $amount;

    /**
     * @var \DateTime
     *
     * @Type("DateTime<'d.m.Y'>")
     */
    private $date;

    /**
     * TransactionsRepresentation constructor.
     * @param int $transactionId
     * @param float $amount
     * @param \DateTime $date
     */
    public function __construct($transactionId, $amount, \DateTime $date)
    {
        $this->transactionId = $transactionId;
        $this->amount = $amount;
        $this->date = $date;
    }
}