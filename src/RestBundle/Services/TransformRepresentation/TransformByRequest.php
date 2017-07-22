<?php
/**
 * Created by PhpStorm.
 * User: serjio
 * Date: 22.07.17
 * Time: 19:40
 */

namespace RestBundle\Services\TransformRepresentation;

use JMS\Serializer\SerializerInterface;
use RestBundle\Representation\RepresentationInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ValidatorInterface;

class TransformByRequest
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var string
     */
    private $classPath = \stdClass::class;

    /**
     * TransformRepresentation constructor.
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     */
    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * @param string $classPath
     */
    public function setClassPath(string $classPath)
    {
        $this->classPath = $classPath;
    }

    /**
     * @param Request $request
     *
     * @return RepresentationInterface
     * @throws HttpException
     */
    public function createRepresentation(Request $request) : RepresentationInterface
    {
        $representation = $this->transformContent($request->getContent());
        $this->validation($representation);

        return $representation;
    }

    private function transformContent(string $content) : RepresentationInterface
    {
        return $this->serializer->deserialize($content, $this->classPath, 'json');
    }

    /**
     * @param RepresentationInterface $representation
     *
     * @throws HttpException
     */
    private function validation(RepresentationInterface $representation)
    {
        $errors = $this->validator->validate($representation);

        if (count($errors) > 0) {
            $errorsMessages = [];
            /** @var ConstraintViolation $error */
            foreach ($errors as $error) {
                $errorsMessages['messages'][$error->getPropertyPath()] = $error->getMessage();
            }

            throw new HttpException(400, json_encode($errorsMessages));
        }
    }
}