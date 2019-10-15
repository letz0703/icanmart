<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Seller extends Model
{
    use Searchable;
    protected $guarded = [];
    
    public function getRouteKeyName()
    {
        return 'name';
    }
    
    public function boxes()
    {
        return $this->hasMany(Box::class);
    }
    
}
