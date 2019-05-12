<?php

namespace App\Filters;

use App\Seller;

/**
 * Class BoxFilters
 * @package App\Filters
 */
class BoxFilters extends Filters
{
    protected $filters = ['from'];
    
    protected function from($boxSellerName)
    {
        $seller = Seller::where('name', $boxSellerName)->firstOrFail();
        
        return $this->builder->where('seller_id', $seller->id);
    }
    
}