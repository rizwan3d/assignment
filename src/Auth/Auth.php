<?php

namespace App\Auth;

use App\Domain\User;
use Firebase\JWT\JWT;

class Auth{

	private static $user;
	public static $secret = 'ASSIGNMENTKEY';

	public static function setAuth($data){
		try{
			$user = User::findOrFail($data->data->user_id);
			Auth::$user = $user;
			return true;
		}catch(\Exception $e){
			return false;
		}
	}

    public static function hash($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function verifyPassword($user,$password){
        return password_verify($password, $user->password);
    }

	public static function login($user){
		$token = [
			"iat" => time(),
			"exp" => time() + 2592000,
			"data" => [
				"user_id" => $user->id
			]
		];

		return JWT::encode($token, Auth::$secret, 'HS256');
	}

	public static function user(){
		return Auth::$user;
	}

}