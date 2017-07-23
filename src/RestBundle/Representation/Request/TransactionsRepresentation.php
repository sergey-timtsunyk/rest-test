<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 22.07.17
 * Time: 21:40
 */

namespace RestBundle\Representation\Request;


use RestBundle\Representation\RepresentationInterface;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;

class TransactionsRepresentation implements RepresentationInterface
{
    /**
     * @var float
     *
     * @Type("float")
     * @Assert\Callback({"RestBundle\Representation\Validator\AmountValidator", "validate"})
     * @Assert\NotBlank()
     */
    private $amount;

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }
}