<?php
namespace App\Action\UserAction;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Domain\User;

final class AddUserAction extends Action
{
    public function __invoke(Request $request, Response $response): Response{

        $data = (array)$request->getParsedBody();

        $validation = $this->validate($data, [
            'user_name' => 'required|regex:/^[a-zA-Z\ ]+$/u|min:3|max:20',
            'email' => 'required|email',
            'phone_no' => 'required|regex:/^[0-9]/|max:12',
            'address' => 'required|regex:/(^[-0-9A-Za-z.,\/ ]+$)/|max:50',
            'password' =>  'required|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/'
        ]);

        if($validation){
            return $this->responce($response, $validation, 401);
        }

        try{
            if (User::where('email',$data['email'])->exists()) {
                return $this->responce($response, [['message'] => 'Email already exists'], 409 );
            }

            $newUser = new User();
            $newUser->user_name = $data['user_name'];
            $newUser->email = $data['email'];
            $newUser->password = password_hash($data['password'], PASSWORD_DEFAULT);
            $newUser->phone_no = $data['phone_no'];
            $newUser->address = $data['address'];
            $newUser->save();
            return $this->success($response, $newUser);

        }catch(\Exception $e){
            return $this->error($response, $e->getMessage());
        }
    }
}
