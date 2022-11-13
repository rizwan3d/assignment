<?php

namespace App\Action\UserAction;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Domain\User;


final class GetUserAction extends Action{

    /**
     * Get all users list.
     *
     * @return object {
     *           "message" : "user list",
     *           "data" : array
     * }
     */

    public function __invoke(Request $request, Response $response, $args): Response {

//        $data = $request->getQueryParams();
//        $validation = $this->validate($data, [
//            'per_page' => 'required|integer',
//            'page' => 'required|integer',
//        ]);
//
//        if($validation){
//            return $this->responce($response, $validation, 401);
//        }

        try{

            $requestParams = $request->getQueryParams();

//            $users = User::paginate($requestParams['per_page'], ['*'], 'page', $requestParams['page']);
            $users = User::paginate(150);

            $data = ['message' => 'user list', 'data' => $users];
            return $this->success($response,$data);

        } catch (\Exception $e) {
            return $this->error($response, $e->getMessage());
       }

    }

}