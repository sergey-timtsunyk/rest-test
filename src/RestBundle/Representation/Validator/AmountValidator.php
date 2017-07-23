<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 22.07.17
 * Time: 23:15
 */

namespace RestBundle\Representation\Validator;

use Symfony\Component\Validator\Context\ExecutionContextInterface;

class AmountValidator
{
    /**
     * @param $object
     * @param ExecutionContextInterface $context
     */
    public static function validate($object, ExecutionContextInterface $context)
    {
        if (!preg_match('/^\d{1,10}.\d{2}$/', $object)) {
            $context->buildViolation('Incorrect amount format, should contain from 10 to 1 characters to the point and 2 characters after the point.')
                ->atPath('amount')
                ->addViolation();
        }
    }
}