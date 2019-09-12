<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'nombre', 'rif', 'direccion', 'telefono', 'estatud', 'type_id'
    ];

    public function Type(){
        
        return $this->belongsTo(Type::class);
    }
}