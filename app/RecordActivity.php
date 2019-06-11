<?php

namespace App;


trait RecordActivity
{
    protected static function bootRecordActivity()
    {
        if (auth()->guest()) return ;
        
        foreach (static::activitiesToRecord() as $event){
            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }
    }
    
    protected static function activitiesToRecord()
    {
        return ['created'];
    }
    
    
    public function recordActivity($eventType)
    {
        //Activity::create([
        $this->activity()->create([
            'user_id' => auth()->id(),
            'type'    => $eventType . '_' . strtolower(class_basename($this)),
        ]);
    }
    
    public function activity()
    {
        return $this->morphMany('App\Activity', 'object');
    }
    
}