<?php


namespace App\Filters;


use Illuminate\Http\Request;

class ItemFilters extends Filters
{
    protected $filters = ['barcode'];
    
    
    /**
     * @return mixed
     */
    protected function barcode($barcode)
    {
        return $this->builder->where('barcode', $barcode);
    }
    
}