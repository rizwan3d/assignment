<?php

namespace App\Action\UserAction;

use App\Action\Action;
use App\Domain\ViewUserTransaction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class GetUserTransactionAction extends Action{

    public function __invoke(Request $request, Response $response, $args): Response {
    
        try{

            $requestParams = $request->getQueryParams();
            $validation = $this->validate($requestParams, [
//                'per_page' => 'required|integer',
                'page' => 'required|integer',
            ]);

            if($validation){
                return $this->responce($response, $validation, 401);
            }

            $transactions = ViewUserTransaction::query();

            if (!empty($requestParams['user_name'])){
                $transactions = $transactions->where('user_name','LIKE' ,  '%' . $requestParams['user_name'] .'%' );
            }

            if (!empty($requestParams['location_name'])){
                $transactions = $transactions->where('address','LIKE' ,  '%' . $requestParams['location_name'] .'%' );
            }

            if (!empty($requestParams['date'])){
                $transactions = $transactions->whereDate('created_at',$requestParams['date'] );
            }

            $transactions = $transactions->paginate(50, ['*'], 'page', $requestParams['page']);
//            $transactions = $transactions->paginate(20);
            $data = ['message' => 'user transactions', 'data' => $transactions];

            return $this->success($response,$data);

        } catch (\Exception $e) {
            return $this->error($response, $e->getMessage());
       }

    }

}