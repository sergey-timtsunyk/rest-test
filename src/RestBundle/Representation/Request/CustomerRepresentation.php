<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 22.07.17
 * Time: 18:32
 */

namespace RestBundle\Representation\Request;

use JMS\Serializer\Annotation\Type;
use RestBundle\Representation\RepresentationInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CustomerRepresentation implements RepresentationInterface
{
    /**
     * @var string
     *
     * @Type("string")
     *
     * @Assert\Type("string")
     * @Assert\Length(max = 25, maxMessage = "Your name cannot be longer than {{ limit }} characters")
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     *
     * @Type("string")
     *
     * @Assert\Type("string")
     * @Assert\Length(
     *     min = 13,
     *     max = 13,
     *     minMessage = "Your cnp must be at least {{ limit }} characters long",
     *     maxMessage = "Your cnp cannot be longer than {{ limit }} characters"
     * )
     */
    private $cpn;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCpn(): string
    {
        return $this->cpn;
    }
}