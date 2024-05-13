<?php
namespace GenericApi;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::IS_REPEATABLE)]
class GenericApiValidation {
    public string $rule;

    public function __construct(string $rule) {
        $this->rule = $rule;
    }

}