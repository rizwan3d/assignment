<?php

use DI\ContainerBuilder;
use Slim\App;
use Framework\Config\_Global;
use \Illuminate\Database\Capsule\Manager as DB;

require_once __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

// Add DI container definitions
$containerBuilder->addDefinitions(__DIR__ . '/container.php');

// Create DI container instance
$container = $containerBuilder->build();

// Create Slim App, DB and Global Setting instance
$app = $container->get(App::class);
$global = $container->get(_Global::class);
$container->get(DB::class);

// Register routes
(require __DIR__ . '/../routes/routes.php')($app);

// Register middleware
(require __DIR__ . '/../middleware/middleware.php')($app);

return $app;