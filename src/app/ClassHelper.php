<?php

namespace GenericApi;

class ClassHelper
{
    public function loadClass($class, $newData){
        $reflectionClass = (new \ReflectionClass($class));
        $properties = $reflectionClass->getProperties();
        foreach ($properties as $property) {
            // Check if the ORM is using the validation
            $attributes = $property->getAttributes(\GenericApi\GenericApiValidation::class);
            foreach($attributes as $attribute){
                $attributeName = $attribute->newInstance()->rule;
                // @todo implement the error messaging coming back from validate
                if((new ValidationHelper())->validate($attributeName, $class->{$property->name})){

                    return false;
                }
            }
            // @todo protect overwriting of Tina4 properties
            if(isset($newData->{$property->name})){
                $class->{$property->name} = $newData->{$property->name};
            }
        }

        return $class;
    }

}