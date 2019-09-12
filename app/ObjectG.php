<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObjectG extends Model
{
    public function Objective(){
        
        return $this->belongsTo(Objective::class);
    }
}
