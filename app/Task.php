<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use RecordsActivity;

    protected $guarded = [];
    protected $touches = ['project'];

    public static $eventsToRecord = ['created','updated'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }


    public function path()
    {
        return $this->project->path().'/tasks/'.$this->id;
    }

    public function complete()
    {
        $this->completed  = true;
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }


}
