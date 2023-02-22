<?php

namespace common\components\form;

use ReflectionClass;
use ReflectionProperty;
use Yiisoft\Validator\Error;
use Yiisoft\Validator\Validator;

abstract class AbstractForm implements FormInterface
{
    public function __construct(
        public Validator $validator
    ) {

    }

    abstract protected function rules(): array;

    public function validate(): array
    {
        $validate = $this->validator->validate($this->getAttributes(), $this->rules());
        $isValid = $validate->isValid();
        if (!$isValid) {
            return $this->getErrors($validate);
        }

        return [];
    }

    private function getErrors($validate): array
    {
        $data = [];
        foreach ($validate->getErrors() as $validator) {
            if ($validator instanceof Error) {
                $data[] = $validator->getMessage();
            }
        }

        return $data;
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
