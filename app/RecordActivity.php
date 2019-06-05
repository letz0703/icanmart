<?php

namespace App;


trait RecordActivity
{
    
    protected static function bootRecordActivity()
    {
        static::created( function($box){
            $box->recordActivity('created');
        });
    }
    
    
    public function recordActivity($eventType)
    {
        //Activity::create([
        $this->activity()->create([
            'user_id'     => auth()->id(),
            'type'        => $eventType . '_' . strtolower(class_basename($this)),
        ]);
    }
    
    public function activity()
    {
        return $this->morphMany('App\Activity', 'object');
    }
    
}