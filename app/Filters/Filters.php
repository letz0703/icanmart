<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{
    
    protected $filters = [];
    
    /**
     * @var Request
     */
    protected $request, $builder;
    
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    public function apply($builder)
    {
        $this->builder = $builder;
        
        foreach ($this->filters as $filter){
            if ( ! $this->hasFilters($filter))
                return;
            
            return $this->$filter($this->request->$filter);
        }
        
        return $this->builder;
    }
    
    /**
     * @param $filter
     *
     * @return bool
     */
    protected function hasFilters($filter): bool
    {
        return method_exists($this, $filter) && $this->request->has($filter);
    }
}