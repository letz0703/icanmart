<?php

namespace App\Filters;

use App\Seller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class BoxFilters
 * @package App\Filters
 */
class BoxFilters
{
    
    /**
     * @var Request
     */
    protected $request;
    protected $builder;
    
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    public function apply($builder)
    {
        $this->builder = $builder;
        
        if ($this->request->has('from')){
            return $this->from($this->request->from);
        }
        return $builder;
    }
    
    /**
     * @param $boxSellerName
     *
     * @return mixed
     */
    protected function from($boxSellerName)
    {
        $seller = Seller::where('name', $boxSellerName)->firstOrFail();
        
        return $this->builder->where('seller_id', $seller->id);
    }
    
}