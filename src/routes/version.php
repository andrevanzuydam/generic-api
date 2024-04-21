<?php
namespace Tina4GenericApi;

use Tina4;

\Tina4\Get::add("/ping", function(Tina4\Response $response){
    $version = [
        "name" => "generic-api",
        "version" => "v0.0.1-alpha"
    ];
    return $response($version, HTTP_OK, APPLICATION_JSON);
});
