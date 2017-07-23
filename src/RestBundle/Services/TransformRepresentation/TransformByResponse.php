<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 23.07.17
 * Time: 0:49
 */

namespace RestBundle\Services\TransformRepresentation;


use JMS\Serializer\SerializerInterface;
use PaymentBundle\Entity\Transaction;
use RestBundle\Representation\RepresentationInterface;

abstract class TransformByResponse
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * TransformByResponse constructor.
     *
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param Transaction $transaction
     *
     * @return array
     */
    public function transactionsRepresentationArrayFormat(Transaction $transaction) : array
    {
        return $this->serializer->deserialize(
            $this->serializer->serialize($this->createRepresentation($transaction), 'json'),
            'array',
            'json'
        );
    }

    /**
     * @param Transaction $transaction
     *
     * @return RepresentationInterface
     */
    abstract protected function createRepresentation(Transaction $transaction) : RepresentationInterface;
}