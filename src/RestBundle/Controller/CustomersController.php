<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 22.07.17
 * Time: 17:37
 */

namespace RestBundle\Controller;

use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\FOSRestController;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use PaymentBundle\Entity\Customer;
use RestBundle\Representation\Request\CustomerRepresentation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Resource handler to the customers
 * @package RestBundle\Controller
 *
 * @RouteResource("Customers")
 */
class CustomersController extends FOSRestController
{
    /**
     * @View(serializerGroups={"created"})
     *
     * @ApiDoc(
     *     description="Create a new customer",
     *     headers={
     *          {
     *              "name"="Authorization",
     *              "required" = "true",
     *              "description"="Use authentication token [Bearer access_token]"
     *          },
     *          {
     *              "name"="Content-Type",
     *              "required" = "true",
     *              "description"="Type must be [application/json]"
     *          },
     *      },
     *
     *      input="RestBundle\Representation\Request\CustomerRepresentation",
     *      output={
     *          "class"="PaymentBundle\Entity\Customer",
     *          "groups"={"created"}
     *      },
     *      statusCodes={
     *         201="Returned when created"
     *      }
     * )
     *
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

        return $this->handleView($this->view($customer, 201));
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