<?php

namespace GenericApi;

class ClassHelper
{
//    public function loadClass($class, $newData){
//        $reflectionClass = (new \ReflectionClass($class));
//        $properties = $reflectionClass->getProperties();
//        foreach ($properties as $property) {
//            // Check if the ORM is using the validation
//            $attributes = $property->getAttributes(\GenericApi\GenericApiValidation::class);
//            foreach($attributes as $attribute){
//                $attributeName = $attribute->newInstance()->rule;
//                // @todo implement the error messaging coming back from validate
//                $result = (new ValidationHelper())->validate($attributeName, $class->{$property->name});
//                if(!$result["valid"]){
//
//                    return false;
//                }
//            }
//            // @todo protect overwriting of Tina4 properties
//            if(isset($newData->{$property->name})){
//                $class->{$property->name} = $newData->{$property->name};
//            }
//        }
//
//        return $class;
//    }

    /**
     * Function to validate and update a class and pass the class back to the calling function. Note no save is done in this function.
     * @param $className
     * @param $id
     * @param $newData
     * @return false|object
     * @throws \ReflectionException
     */
    public function patchClass($className, $id, $newData):bool|object
    {
        if(class_exists($className))
        {
            $class = (new $className())->load("id = ?", [$id]);
            if ($class)
            {
                $reflectionClass = (new \ReflectionClass($class));
                $properties = $reflectionClass->getProperties();
                foreach ($properties as $property) {
                    // Check if the ORM is using the validation
                    $attributes = $property->getAttributes(\GenericApi\GenericApiValidation::class);
                    foreach($attributes as $attribute){
                        $attributeName = $attribute->newInstance()->rule;
                        // @todo implement the error messaging coming back from validate
                        $result = (new ValidationHelper())->validate($attributeName, $class->{$property->name});
                        if(!$result["valid"]){

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

        return false;
    }



}