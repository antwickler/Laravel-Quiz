<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Skill;

class Student extends Model
{
     protected $fillable = ['name','email','major','user_id','ip'];

     public function user() {
     	return $this->belongsTo(User::class);
     }

    public function skills() {
    	return $this->belongsToMany(Skill::class);
    }
}
