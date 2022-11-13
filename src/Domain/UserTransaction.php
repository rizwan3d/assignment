<?php

namespace App\Domain;
use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model{

   protected $table = 'user_transactions';
   protected $fillable = ['amount','medium','user_id','location_id','created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by'];
   protected $hidden = ['updated_at','deleted_at','created_by','updated_by', 'deleted_by', 'password'];

}