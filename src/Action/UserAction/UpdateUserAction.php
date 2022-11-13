<?php
namespace App\Action\UserAction;

use App\Action\Action;
use Illuminate\Support\Facades\Hash;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Domain\User;

final class UpdateUserAction extends Action
{
    public function __invoke(Request $request, Response $response): Response{

        $data = (array)$request->getParsedBody();

        $validation = $this->validate($data, [
            'id' => 'required|numeric',
            'user_name' => 'regex:/^[a-zA-Z\ ]+$/u|min:3|max:20',
            'phone_no' => 'regex:/^[0-9]/|max:12',
            'address' => 'regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:50',
        ]);

        if($validation){
            return $this->responce($response, $validation, 401);
        }

        try{

            $userObject = User::find($data['id']);
            $userObject->user_name = $data['user_name'] ?? $userObject->user_name;
            $userObject->phone_no = $data['phone_no'] ?? $userObject->phone_no;
            $userObject->address = $data['address'] ?? $userObject->address;
            $userObject->save();
            return $this->success($response, $userObject);

        }catch(\Exception $e){
            return $this->error($response, $e->getMessage());
        }
    }
}
    
