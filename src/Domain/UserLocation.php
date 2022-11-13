<?php

namespace App\Domain;
use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model{

   protected $table = 'user_locations';
   protected $fillable = ['user_id','address','city','state', 'zip','lat','lng','created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by'];
   protected $hidden = ['updated_at','deleted_at','created_by','updated_by', 'deleted_by', 'password'];

}