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
use RestBundle\Representation\CustomerRepresentation;
use RestBundle\Services\TransformRepresentation\TransformByRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Resource handler to the customers
 * @package RestBundle\ResourceHandler
 *
 * @RouteResource("Customers")
 */
class CustomerHandler extends FOSRestController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function postAction(Request $request)
    {
        /** @var CustomerRepresentation $customerRepresentation */
        $customerRepresentation = $this->getTransformByRequest()->createRepresentation($request);
        $customer = $this
            ->getDoctrine()
            ->getRepository(Customer::class)
            ->createByUserRepresentation($customerRepresentation);

        return $this->handleView($this->view(["id" => $customer->getId()], 201));
    }

    /**
     * @return TransformByRequest
     */
    public function getTransformByRequest() : TransformByRequest
    {
        return $this->get('rest.services_transform_representation.transform_by_request.user_representation');
    }
}