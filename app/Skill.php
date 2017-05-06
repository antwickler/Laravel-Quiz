<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
     public function students() {
    	return $this->belongsToMany(Student::class)->withTimeStamps();
    }
}
