<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use RecordsActivity;

    protected $guarded = [];
    protected $touches = ['project'];

    protected static $recordableEvents = ['created','deleted'];

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

}
