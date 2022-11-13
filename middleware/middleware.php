<?php

use Slim\App;
use App\Middleware\CORSMiddleware;
use App\Middleware\HTMLErrorMiddleware;


return function (App $app) {

    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    // Add the Slim built-in routing middleware
    $app->addRoutingMiddleware();

    // Handle exceptions
    $errorMiddleware = $app->addErrorMiddleware(true, true, true);
    $errorMiddleware->setDefaultErrorHandler(JSONErrorMiddleware::class);
    
    $app->add(CORSMiddleware::class);

};