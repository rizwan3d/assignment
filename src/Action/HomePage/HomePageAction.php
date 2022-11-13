<?php

namespace App\Action\HomePage;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Domain\User;
use Respect\Validation\Validator as v;

final class HomePageAction extends Action{

    public function __invoke(Request $request, Response $response, $args): Response {

        die('Welcome to home page');
    }

}