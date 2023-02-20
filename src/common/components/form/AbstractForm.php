<?php

namespace common\components\form;

use ReflectionClass;
use ReflectionProperty;
use Yiisoft\Validator\Result;
use Yiisoft\Validator\Validator;
use Yiisoft\Validator\ValidatorInterface;

abstract class AbstractForm implements FormInterface
{
    private ValidatorInterface $validator;
    private Result $result;

    public function __construct() {
        $this->validator = new Validator();
    }

    abstract protected function rules(): array;

    public function validate(): array
    {
        $validate = $this->validator->validate($this->getAttributes(), $this->rules());
        $isValid = $validate->isValid();

        if (!$isValid) {
            return $this->result->getErrors();
        }

        return [];
    }

    public function setAttributes(array $attributes = []): void
    {
        foreach ($attributes as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }

    public function getAttributes(): array
    {
        $reflectionClass = new ReflectionClass($this);

        $attributes = [];
        foreach ($reflectionClass->getProperties(ReflectionProperty::IS_PUBLIC) as $name) {
            $property = $name->getName();
            $attributes[$property] = $this->{$property};
        }

        return $attributes;
    }
}
