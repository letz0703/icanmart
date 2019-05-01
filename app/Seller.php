<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    
    //public function getRouteKeyName()
    //{
    //    return 'name';
    //}
    
    public function boxes()
    {
        return $this->hasMany(Box::class);
    }
    
}
