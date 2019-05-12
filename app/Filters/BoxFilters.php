<?php

namespace App\Filters;

use App\Seller;
use Symfony\Component\HttpFoundation\Request;

class BoxFilters
{
    
    /**
     * @var Request
     */
    protected $request;
    
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    public function apply($builder)
    {
        if ( ! $boxSellerName = $this->request->from){
            return $builder;
        }
        $seller = Seller::where('name', $boxSellerName)->firstOrFail();
        
        return $builder->where('seller_id', $seller->id);
    }
    
}