<?php
namespace Tina4GenericApi;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::IS_REPEATABLE)]
class JbGapiValidation {
    public string $rule;

    public function __construct(string $rule) {
        $this->rule = $rule;
    }

}