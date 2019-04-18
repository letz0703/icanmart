<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    public function path()
    {
        return '/items/'.$this->id;
    }
    
}
