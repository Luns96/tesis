<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    public function Project(){
        
        return $this->belongsTo(Project::class);
    }
    public function Goal(){
        
        return $this->hasMany(Goal::class);
    }
}
