<?php

/**
 * Route to get a token for use throughout the api
 * Relies on variables in the .env to link into the appropriate user table
 */
\Tina4\Get::add("/api/rest/V1/auth/getToken", function(Tina4\Response $response, Tina4\Request $request){
    // Check if the incoming header has the appropriate key
    if(!isset($_SERVER["HTTP_ACCESSKEY"])){
        return $response("Sorry, but there is no ApiKey in the header. Please refer to your documentation.", HTTP_FORBIDDEN);
    }
    // Attempt to load the user
    $class = $_ENV["API_USER_CLASS"];
    $user = (new AuthHelper($class))->getTokenFromKey();
    if(!$user){
        return $response("Sorry, but there is no user found.", HTTP_NOT_FOUND);
    }
    // Put the userId into the token for further use.
    $token = ["token" => (new \Tina4\Auth())->getToken(["userId" => $user->id, 1])];
    return $response($token, HTTP_OK);
});