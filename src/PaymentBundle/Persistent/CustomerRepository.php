<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 22.07.17
 * Time: 20:53
 */

namespace PaymentBundle\Persistent;


use AuthenticationBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use PaymentBundle\Entity\Customer;
use RestBundle\Representation\CustomerRepresentation;

class CustomerRepository extends EntityRepository
{
    /**
     * @param CustomerRepresentation $representation
     *
     * @return Customer
     */
    public function createByUserRepresentation(CustomerRepresentation $representation) : Customer
    {
        $user = new Customer();
        $user->setName($representation->getName());
        $user->setCnp($representation->getCpn());

        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush($user);

        return $user;
    }
}