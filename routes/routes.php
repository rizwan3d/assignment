<?php

use Slim\App;
use App\Action\UserAction\GetUserAction;
use App\Action\UserAction\AddUserAction;
use App\Action\UserAction\UpdateUserAction;
use App\Action\UserAction\GetUserTransactionAction;
use App\Action\UserAction\SingleUserAction;
use App\Action\Locations\GetLocationAction;
use App\Action\HomePage\HomePageAction;
use App\Action\UserAction\UserLoginAction;
use App\Action\UserAction\IsUserLoginAction;
use App\Middleware\AuthMiddleware;

return function (App $app) {

    // home page routes
    $app->get('/', HomePageAction::class);

    // login api
    $app->post('/user-login', UserLoginAction::class);

    // make group to add api in auth
//    $app->group('', function () use ($app) {

            // user routes
            $app->get('/user', GetUserAction::class);
            $app->get('/is-user-login', IsUserLoginAction::class);
            $app->get('/user-single/{id}', SingleUserAction::class);
            $app->get('/user-transaction', GetUserTransactionAction::class);
            $app->post('/user-add', AddUserAction::class);
            $app->put('/user-update', UpdateUserAction::class);
            $app->get('/location', GetLocationAction::class);

//    })->add(AuthMiddleware::class);

};