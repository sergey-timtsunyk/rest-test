<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 22.07.17
 * Time: 23:39
 */

namespace PaymentBundle\Persistent;


use Doctrine\ORM\EntityRepository;
use PaymentBundle\Entity\Customer;
use PaymentBundle\Entity\Transaction;
use RestBundle\Representation\Request\TransactionsRepresentation;

class TransactionRepository extends EntityRepository
{
    /**
     * @param Customer $customer
     * @param TransactionsRepresentation $transactionRepresentation
     *
     * @return Transaction
     *
     * @throws \Exception
     */
    public function createByTransactionRepresentation(
        Customer $customer,
        TransactionsRepresentation $transactionRepresentation
    ): Transaction
    {
        $this->getEntityManager()->beginTransaction();
        try {
            $transaction = new Transaction();
            $transaction->setCustomer($customer);
            $transaction->setAmount($transactionRepresentation->getAmount());

            $this->getEntityManager()->persist($transaction);
            $this->getEntityManager()->flush();

            $this->getEntityManager()->commit();
        } catch (\Exception $e) {
            $this->getEntityManager()->rollBack();
            throw $e;
        }

        return $transaction;
    }

    /**
     * @param Transaction $transaction
     * @param TransactionsRepresentation $transactionRepresentation
     *
     * @return Transaction
     *
     * @throws \Exception
     */
    public function updateByTransactionRepresentation(
        Transaction $transaction,
        TransactionsRepresentation $transactionRepresentation
    ): Transaction
    {
        $this->getEntityManager()->beginTransaction();
        try {
            $transaction->setAmount($transactionRepresentation->getAmount());

            $this->getEntityManager()->persist($transaction);
            $this->getEntityManager()->flush();

            $this->getEntityManager()->commit();
        } catch (\Exception $e) {
            $this->getEntityManager()->rollBack();
            throw $e;
        }

        return $transaction;
    }

    /**
     * @param Transaction $transaction
     *
     * @throws \Exception
     */
    public function delete(Transaction $transaction)
    {
               $this->getEntityManager()->beginTransaction();
        try {

            $this->getEntityManager()->remove($transaction);
            $this->getEntityManager()->flush();

            $this->getEntityManager()->commit();
        } catch (\Exception $e) {
            $this->getEntityManager()->rollBack();
            throw $e;
        }
    }

    /**
     * @param int $customerId
     * @param float $amount
     * @param string $date
     * @param int $offset
     * @param int $limit
     *
     * @return array
     */
    public function selectionArrayValuesByFilter(int $customerId, float $amount, string $date, int $offset, int $limit) : array
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select(['t.id as transactionId','t.amount', 'DATE_FORMAT(t.date, \'%d.%m.%Y\') as date'])
            ->from(Transaction::class, 't');

        empty($customerId) ?: $qb->andWhere('t.customer = :customer')->setParameter('customer', $customerId);
        empty($amount) ?: $qb->andWhere('t.amount = :amount')->setParameter('amount', $amount);
        empty($date) ?: $qb->andWhere($qb->expr()->between('t.date', ':from', ':to'))
            ->setParameter('from', new \DateTime($date.' 00:00:00'))
            ->setParameter('to', new \DateTime($date.' 23:59:59'));

        $qb->orderBy('t.id', 'ASC');

        return $qb->getQuery()->setMaxResults($limit)->setFirstResult($offset)->getArrayResult();
    }

    /**
     * @param \DateTime $date
     *
     * @return float
     */
    public function sumByDate(\DateTime $date) : float
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select(['SUM(t.amount)'])
            ->from(Transaction::class, 't')
            ->andWhere($qb->expr()->between('t.date', ':from', ':to'))
            ->setParameter('from', new \DateTime($date->format('d.m.Y').' 00:00:00'))
            ->setParameter('to', new \DateTime($date->format('d.m.Y').' 23:59:59'));

        return $qb->getQuery()->getSingleScalarResult();
    }
}
