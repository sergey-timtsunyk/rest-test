<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 22.07.17
 * Time: 21:24
 */

namespace RestBundle\ResourceHandler;

use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use PaymentBundle\Entity\Customer;
use PaymentBundle\Entity\Transaction;
use RestBundle\Representation\Request\TransactionsRepresentation;
use RestBundle\Services\TransformRepresentation\TransformByResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Resource handler to the transactions
 * @package RestBundle\ResourceHandler
 */
class TransactionsHandler extends FOSRestController
{
    /**
     * @param Customer $customer
     * @param Transaction $transaction
     *
     * @return Response
     */
    public function getCustomersTransactionsAction(Customer $customer, Transaction $transaction)
    {
        if ($transaction->getCustomer()->getId() !== $customer->getId()) {
            throw new NotFoundHttpException();
        }

        return $this->handleView($this->view(
            $this->getTransformTransactionRepresentationResponse()->transactionsRepresentationArrayFormat($transaction)
        ));
    }

    /**
     * @QueryParam(name="customerId", requirements="\d+", default="0", description="")
     * @QueryParam(name="amount", requirements="^\d{1,10}.\d{2}$", default="0", description="format=d.dd")
     * @QueryParam(name="date",  requirements="^\d{2}.\d{2}.\d{4}$", default="", description="format=d.m.Y")
     * @QueryParam(name="offset", requirements="\d+", default="0", description="default=1")
     * @QueryParam(name="limit", requirements="\d+", default="50", description="default=50")
     *
     * @param ParamFetcher $paramFetcher
     *
     * @return Response
     */
    public function getTransactionsFilterAction(ParamFetcher $paramFetcher)
    {
        //var_dump($paramFetcher->all()); exit();

        $collectionTransaction  = $this
            ->getDoctrine()
            ->getRepository(Transaction::class)
            ->selectionArrayValuesByFilter(
                $paramFetcher->get('customerId'),
                $paramFetcher->get('amount'),
                $paramFetcher->get('date'),
                $paramFetcher->get('offset'),
                $paramFetcher->get('limit')
            );

        return $this->handleView($this->view($collectionTransaction));
    }

    /**
     * @param Customer $customer
     * @param Request $request
     *
     * @return Response
     */
    public function postCustomersTransactionsAction(Customer $customer, Request $request)
    {
        $transactionRepresentation = $this->getTransactionRepresentationByRequest($request);

        $transaction = $this
            ->getDoctrine()
            ->getRepository(Transaction::class)
            ->createByTransactionRepresentation($customer, $transactionRepresentation);

        return $this->handleView($this->view(["id" => $transaction->getId()], 201));
    }

    /**
     * @param Transaction $transaction
     * @param Request $request
     *
     * @return Response
     */
    public function putTransactionsAction(Transaction $transaction, Request $request)
    {
        $transactionRepresentation = $this->getTransactionRepresentationByRequest($request);

        $transaction = $this
            ->getDoctrine()
            ->getRepository(Transaction::class)
            ->updateByTransactionRepresentation($transaction, $transactionRepresentation);

        return $this->handleView($this->view(
            $this->getTransformUpdateTransactionRepresentationResponse()->transactionsRepresentationArrayFormat($transaction)
        ));
    }

    /**
     * @param Transaction $transaction
     *
     * @return Response
     */
    public function deleteTransactionsAction(Transaction $transaction)
    {
        $this
            ->getDoctrine()
            ->getRepository(Transaction::class)
            ->delete($transaction);

        return $this->handleView($this->view('success'));
    }

    /**
     * @param Request $request
     *
     * @return TransactionsRepresentation
     */
    private function getTransactionRepresentationByRequest(Request $request) : TransactionsRepresentation
    {
        return $this
            ->get('rest.services_transform_representation.request.transaction_representation')
            ->createRepresentation($request);
    }

    /**
     * @return TransformByResponse
     */
    private function getTransformTransactionRepresentationResponse()
    {
        return $this->get('rest.services_transform_representation.transaction_by_response');
    }

    /**
     * @return TransformByResponse
     */
    private function getTransformUpdateTransactionRepresentationResponse()
    {
        return $this->get('rest.services_transform_representation.update_transaction_by_response');
    }
}