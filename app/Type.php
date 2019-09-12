<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'nombre', 'estatud'
    ];

    public function Company(){
        
        return $this->hasOne(Type::class);
    }
}
