<?php

namespace GenericApi;

interface ValidationInterface
{
    /**
     * This is the built in validation function. Please see the documentation for the expected attribute types.
     * Overwriting this function should be unnecessary as custom validation should be done by overwriting the
     * beforeValidate and afterValidate functions.
     * @param string $attribute The attribute identifier to be processed
     * @param mixed $value The value can be a string, array, object however best keep it the same throughout
     * @param string $error An error message that can be passed back through the system
     * @return array ["valid" => 1, "value" => "Just pass through or modified value"]
     */
    public function validate(string $attribute, mixed $value, string $error = ""): array;

    /**
     * This function allows manipulation of values or custom validation before the built in validation
     * @param string $attribute The attribute identifier to be processed
     * @param mixed $value The value can be a string, array, object however best keep it the same throughout
     * @param string $error An error message that can be passed back through the system
     * @return array ["valid" => 1, "value" => "Just pass through or modified value"]
     */
    public function beforeValidate(string $attribute, mixed $value, string $error = ""): array;

    /**
     * This function allows manipulation of values or custom validation after the built in validation
     * @param string $attribute The attribute identifier to be processed
     * @param mixed $value The value can be a string, array, object however best keep it the same throughout
     * @param string $error An error message that can be passed back through the system
     * @return array ["valid" => 1, "value" => "Just pass through or modified value"]
     */
    public function afterValidate(string $attribute, mixed $value, string $error = ""): array;

}