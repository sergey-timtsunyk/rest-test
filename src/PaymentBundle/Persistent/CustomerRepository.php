<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 22.07.17
 * Time: 20:53
 */

namespace PaymentBundle\Persistent;

use Doctrine\ORM\EntityRepository;
use PaymentBundle\Entity\Customer;
use RestBundle\Representation\Request\CustomerRepresentation;

class CustomerRepository extends EntityRepository
{
    /**
     * @param CustomerRepresentation $representation
     *
     * @return Customer
     */
    public function createByCustomerRepresentation(CustomerRepresentation $representation) : Customer
    {
        $customer = new Customer();
        $customer->setName($representation->getName());
        $customer->setCnp($representation->getCpn());

        $this->getEntityManager()->persist($customer);
        $this->getEntityManager()->flush($customer);

        return $customer;
    }
}