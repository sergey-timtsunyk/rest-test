<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 23.07.17
 * Time: 1:11
 */

namespace RestBundle\Representation\Response;

use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use RestBundle\Representation\RepresentationInterface;

class FullTransactionRepresentation implements RepresentationInterface
{
    /**
     * @var integer
     *
     * @Type("integer")
     * @SerializedName("customerId")
     */
    private $customerId;

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
     * @param int $customerId
     * @param int $transactionId
     * @param float $amount
     * @param \DateTime $date
     */
    public function __construct($customerId, $transactionId, $amount, \DateTime $date)
    {
        $this->customerId = $customerId;
        $this->transactionId = $transactionId;
        $this->amount = $amount;
        $this->date = $date;
    }
}