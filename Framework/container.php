<?php

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use \Illuminate\Database\Capsule\Manager as DB;
use Framework\Config\_Global;

return [
    _Global::class => function (ContainerInterface $container) {
        $data = require '../Global.php';
        return new _Global($data);
    },

    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);

        return AppFactory::create();
    },

    DB::class => function (ContainerInterface $container) {

        $settings = $container->get(_Global::class);

        $capsule = new DB();

        $capsule->addConnection($settings->get('db'));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        return $capsule;
    }

];