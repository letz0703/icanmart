<?php


namespace App\Filters;


use Illuminate\Http\Request;

class ItemFilters
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
        if ( $this->request->has('barcode')){
            return $this->barcode($this->request->barcode);
        }
        return $this->builder;
    }
    
    /**
     * @return mixed
     */
    protected function barcode($barcode)
    {
        return $this->builder->where('barcode', $barcode);
    }
    
}