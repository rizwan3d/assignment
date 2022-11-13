<?php
namespace App\Action\UserAction;

use App\Action\Action;
use Illuminate\Support\Facades\Hash;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Domain\User;

final class IsUserLoginAction extends Action
{
    public function __invoke(Request $request, Response $response): Response{
        try{
            return $this->responce($response, '', 200);

        }catch(\Exception $e){
            return $this->error($response, $e->getMessage());
        }
    }
}
    
