<?php


namespace App;


use Illuminate\Support\Facades\Redis;

class ViewedBoxes
{
    public function get()
    {
        return array_map('json_decode', Redis::zrevrange($this->cacheKey(), 0, 4));
    }
    
    public function push($box)
    {
        Redis::zincrby($this->cacheKey(), 1, json_encode([
            'title' => $box->title,
            'path'  => $box->path(),
        ]));
    }
    
    public function cacheKey()
    {
        return app()->environment('testing')
            ? 'testing_viewed_boxes'
            : 'viewed_boxes';
    }
    
    public function reset()
    {
        Redis::del($this->cacheKey());
    }
    
    
}