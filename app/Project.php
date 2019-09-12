<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function User(){
        
        return $this->hasOne(User::class);
    }

    public function Objective(){
        
        return $this->hasMany(Objective::class);
    }
}
