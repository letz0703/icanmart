<?php


namespace App\Filters;



use App\Item;

class ItemFilters extends Filters
{
    protected $filters = ['barcode', 'popular'];
    
    
    /**
     * @return mixed
     */
    protected function barcode($barcode)
    {
        return $this->builder->where('barcode', $barcode);
    }
    
    protected function popular()
    {
        return $this->builder->orderBy('barcode','desc');
    }
    
    
}