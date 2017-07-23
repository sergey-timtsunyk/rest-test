<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 23.07.17
 * Time: 1:20
 */

namespace RestBundle\Services\TransformRepresentation;


use PaymentBundle\Entity\Transaction;
use RestBundle\Representation\RepresentationInterface;
use RestBundle\Representation\Response\UpdateTransactionsRepresentation;

class TransformUpdateTransactionByResponse extends TransformByResponse
{
    /**
     * @param Transaction $transaction
     *
     * @return RepresentationInterface
     */
    protected function createRepresentation(Transaction $transaction): RepresentationInterface
    {
        return new UpdateTransactionsRepresentation(
            $transaction->getCustomer()->getId(),
            $transaction->getId(),
            $transaction->getAmount(),
            $transaction->getDate()
        );
    }
}