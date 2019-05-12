<?php


namespace App\Filters;



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