<?php

/**
 * @secure
 */
\Tina4\Get::add("/api/rest/V1/generic/{className}/get-one/{id}", function($className, $id, Tina4\Response $response, Tina4\Request $request){
    // Check if the class name provided exists
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

    return $response("This request was not a valid request", HTTP_BAD_REQUEST);
});

/**
 * @secure
 */
\Tina4\Get::add("/api/rest/V1/generic/{className}/get-all", function($className, Tina4\Response $response, Tina4\Request $request){
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
\Tina4\Post::add("/api/rest/V1/generic/{className}", function($className, Tina4\Response $response, Tina4\Request $request){
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