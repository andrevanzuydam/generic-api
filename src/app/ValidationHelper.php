<?php

namespace GenericApi;


class ValidationHelper
{
    /**
    * @inheritDoc
     */
    public function validate(string $attribute, $value, $error = ""): array
    {
        try {
            $result = $this->beforeValidate($attribute, $value);
            if($result["valid"]){
                $value = $result["value"];
            } else {

                return ["valid" => false, "value" => "The {$attribute} test failed in the beforeValidate function."];
            }
        } catch (\Exception $e) {
            return ["valid" => false, "value" => "Fatal error in the beforeValidate function while testing {$attribute}."];
        }


        switch ($attribute){
            case "integer":
                break;
            default:
                break;
        }

        try {
            $result = $this->afterValidate($attribute, $value);
            if($result["valid"]){
                $value = $result["value"];
            } else {

                return ["valid" => false, "value" => "The {$attribute} test failed in the afterValidate function."];
            }
        } catch (\Exception $e) {
            return ["valid" => false, "value" => "Fatal error in the afterValidate function while testing {$attribute}."];
        }

        return ["valid" => true, "value" => $value];
    }

    /**
     * @inheritDoc
     */
    public function beforeValidate(string $attribute, $value, $error = ""): array
    {
        return ["valid" => true, "value" => $value];
    }

    /**
     * @inheritDoc
     */
    public function afterValidate(string $attribute, $value, $error = ""): array
    {
        return ["valid" => true, "value" => $value];
    }

}