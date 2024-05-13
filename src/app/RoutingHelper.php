<?php

namespace GenericApi;

use Tina4;

class RoutingHelper
{
    public static function pascalCase($input){
        $parts = explode('-', $input);

        $output = (implode(array_map(function($arrayElement){
            return ucfirst($arrayElement);
        }, $parts)));

        return $output;
    }
}