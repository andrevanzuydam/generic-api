<?php
namespace GenericApi;

use Tina4;

/**
 * @secure
 */
\Tina4\Get::add($_ENV["GENERIC_API_BASE_URL"] . "/ping", function(Tina4\Response $response){
    $version = [
        "name" => "generic-api"
    ];
    return $response($version, HTTP_OK, APPLICATION_JSON);
});

// @todo look at naming

// @todo look at api pagination
\Tina4\Get::add($_ENV["GENERIC_API_BASE_URL"] . "/{className}/{id}", function($className, $id, Tina4\Response $response, Tina4\Request $request){
    // Deal with any incoming - class names
    $className = RoutingHelper::pascalCase($className);
    // Check if the class name provided exists
    // @todo check if ORM or other class
    // @todo include methods
    if(class_exists($className)){
        // Get the incoming class
        $class = (new $className());

        // Load the class
        $result = $class->load("id = ?", [$id]);

        return $response($result, HTTP_OK);
    }
    // @todo uniform responses
    return $response("This request was not a valid request", HTTP_BAD_REQUEST);
});

/**
 * @secure
 */
\Tina4\Get::add($_ENV["GENERIC_API_BASE_URL"] . "/{className}", function($className, Tina4\Response $response, Tina4\Request $request){
    // Deal with any incoming - class names
    $className = RoutingHelper::pascalCase($className);
    // Check if the class name provided exists
    if(class_exists($className)){
        // Get the incoming class
        $class = (new $className());

        // Set the limits
        $limit = 10;
        $offset = 0;
        if(isset($request->params["limit"]) && isset($request->params["offset"])){
            $limit = min($request->params["limit"],10);
            $offset = $request->params["offset"];
        }
        $result = $class->select("*", $limit, $offset)->asObject();

        return $response($result, HTTP_OK);
    }

    return $response("This request was not a valid request", HTTP_BAD_REQUEST);
});

/**
 * @secure
 */
\Tina4\Post::add($_ENV["GENERIC_API_BASE_URL"] . "/{className}", function($className, Tina4\Response $response, Tina4\Request $request){
    // Deal with any incoming - class names
    $className = RoutingHelper::pascalCase($className);
    // Check if the class name provided exists
    if(class_exists($className)){
        // Get the incoming class
        $class = (new $className($request->data));

        // Save the object based on the request
        // @todo probably need some validation here
        $result = $class->save()->asObject();

        return $response($result, HTTP_OK);
    }

    return $response("This request was not a valid request", HTTP_BAD_REQUEST);
});

/**
 * @secure
 */
\Tina4\Patch::add($_ENV["GENERIC_API_BASE_URL"] . "/{className}/{id}", function($className, $id, Tina4\Response $response, Tina4\Request $request){
    // Deal with any incoming - class names
    $className = RoutingHelper::pascalCase($className);
    // new code
    $class = (new ClassHelper())->patchClass($className, $id, $request->data);
    // end new code
    // Check if the class name provided exists
    if($class)
    {
        $result = $class->save();
        return $response($result, HTTP_OK);
    }

    return $response("This request was not a valid request", HTTP_BAD_REQUEST);
});

/**
 * @secure
 */
\Tina4\Delete::add($_ENV["GENERIC_API_BASE_URL"] . "/{className}/{id}", function($className, $id, Tina4\Response $response, Tina4\Request $request){
    // Deal with any incoming - class names
    $className = RoutingHelper::pascalCase($className);
    // Check if the class name provided exists
    if(class_exists($className)){
        // Get the incoming class
        $class = (new $className());

        // Delete the object based on the request
        // @todo probably need some validation here
        $result = $class->delete("id = ?", [$id]);

        return $response($result, HTTP_OK);
    }

    return $response("This request was not a valid request", HTTP_BAD_REQUEST);
});

//@todo how do we do patch and delete
//@todo how do we deal with overwrites
//@todo how do we expose events that allow before and after changes.

//@todo simple cross table linking