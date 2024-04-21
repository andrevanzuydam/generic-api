<?php
namespace Tina4GenericApi;

use Tina4;

/**
 * @secure
 */
// @todo look at naming
// @todo base url should be in env
// @todo look at api pagination
\Tina4\Get::add("/api/rest/v1/generic/{className}/{id}", function($className, $id, Tina4\Response $response, Tina4\Request $request){
    // Check if the class name provided exists
    // @todo check if ORM or other class
    // @todo include methods
    if(class_exists($className)){
        // Get the incoming class
        $class = (new $className());
        // Check the class allows the generic usage
        if(isset($class->virtualFields["generic"]) && $class->virtualFields["generic"]){
            // Load the class
            $result = $class->load("id = ?", [$id]);

            return $response($result, HTTP_OK);
        }
    }
    // @todo uniform responses
    return $response("This request was not a valid request", HTTP_BAD_REQUEST);
});

/**
 * @secure
 */
// @todo lose the generic and merge in all
\Tina4\Get::add("/api/rest/v1/generic/{className}", function($className, Tina4\Response $response, Tina4\Request $request){
    // Check if the class name provided exists
    if(class_exists($className)){
        // Get the incoming class
        $class = (new $className());
        // Check the class allows the generic usage
        if(isset($class->virtualFields["generic"]) && $class->virtualFields["generic"]){
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
    }

    return $response("This request was not a valid request", HTTP_BAD_REQUEST);
});

/**
 * @secure
 */
\Tina4\Post::add("/api/rest/v1/generic/{className}", function($className, Tina4\Response $response, Tina4\Request $request){
    // Check if the class name provided exists
    if(class_exists($className)){
        // Get the incoming class
        $class = (new $className($request));
        // Check the class allows the generic usage
        if(isset($class->virtualFields["generic"]) && $class->virtualFields["generic"]){
            $result = $class->save()->asObject();

            return $response($result, HTTP_OK);
        }
    }

    return $response("This request was not a valid request", HTTP_BAD_REQUEST);
});

//@todo how do we do patch and delete
//@todo how do we deal with overwrites
//@todo how do we expose events that allow before and after changes.

//@todo simple cross table linking