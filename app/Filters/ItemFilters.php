<?php


namespace App\Filters;


use Illuminate\Http\Request;

class ItemFilters
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
        if (!$barcode = $this->request->barcode){
            return $builder;
        }
        
        return $builder->where('barcode', $barcode);
    }
    
}