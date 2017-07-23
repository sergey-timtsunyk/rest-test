<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 22.07.17
 * Time: 17:37
 */

namespace RestBundle\ResourceHandler;

use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\FOSRestController;
use PaymentBundle\Entity\Customer;
use RestBundle\Representation\Request\CustomerRepresentation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Resource handler to the customers
 * @package RestBundle\ResourceHandler
 *
 * @RouteResource("Customers")
 */
class CustomersHandler extends FOSRestController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function postAction(Request $request)
    {
        $customerRepresentation = $this->getCustomerRepresentationByRequest($request);
        $customer = $this
            ->getDoctrine()
            ->getRepository(Customer::class)
            ->createByCustomerRepresentation($customerRepresentation);

        return $this->handleView($this->view(["id" => $customer->getId()], 201));
    }

    /**
     * @param Request $request
     *
     * @return CustomerRepresentation
     */
    private function getCustomerRepresentationByRequest(Request $request) : CustomerRepresentation
    {
        return $this
            ->get('rest.services_transform_representation.request.customer_representation')
            ->createRepresentation($request);
    }
}