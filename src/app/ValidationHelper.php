<?php

namespace GenericApi;

class ValidationHelper
{
    public function loadClass($class, $newData){
        $reflectionClass = (new \ReflectionClass($class));
        $properties = $reflectionClass->getProperties();
        foreach ($properties as $property) {
            // Check if the ORM is using the validation
            $attributes = $property->getAttributes(GenericApiValidation::class);
            foreach($attributes as $attribute){
                $attributeName = $attribute->newInstance()->rule;
                if(!$this->validate($attributeName, $class->{$property->name})){

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
    
    private function validate($attribute, $value){
        $valid = true;
        switch ($attribute){
            case "integer":
                break;
            default:
                break;
        }
        // Allow for custom validations
        if($valid){
            $valid = $this->extraValidate($attribute, $value);
        }

        return $valid;
    }

    /**
     * By extending this class, this function allows both custom validation and validation extensions.
     * @param string $attribute
     * @param $value
     * @return bool
     */
    private function extraValidate(string $attribute, $value): bool
    {
        return true;
    }
}