<?php

namespace App\Action\UserAction;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Domain\User;


final class SingleUserAction extends Action{

    public function __invoke(Request $request, Response $response,array $args): Response
    {
        try{
            $user = User::findOrFail($args['id']);
            $data = ['message' => 'user information', 'data' => $user];
            return $this->success($response,$data);

        } catch (\Exception $e) {
            return $this->error($e->getMessage());
       }

    }

}