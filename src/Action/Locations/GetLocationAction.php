<?php

namespace App\Action\Locations;

use App\Action\Action;
use App\Domain\UserLocation;
use App\Domain\UserTransaction;
use App\Domain\ViewUserTransaction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Domain\User;


final class GetLocationAction extends Action{

    public function __invoke(Request $request, Response $response, $args): Response {
    
        try{
            $users = UserLocation::groupBy('address')->paginate(30);
            $data = ['message' => 'All locations', 'data' => $users];
            return $this->success($response,$data);

        } catch (\Exception $e) {
            return $this->error($response, $e->getMessage());
       }

    }

}