<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Seller extends Model
{
    use Searchable;
    protected $guarded = [];
    //protected $appends = ['items'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function boxes()
    {
        return $this->hasMany(Box::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function make_slug($string)
    {
        $slug = preg_replace('/\s+/u', '-', trim($string));
        return $slug = str_slug($slug);
    }


}
