<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use RecordsActivity;

    protected $guarded = [];
    protected $touches = ['project'];
    protected $casts= [
        'completed' => 'boolean'
    ];

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
        $this->update(['completed' => true]);
        $this->recordsActivity('completed_task');
    }

    public function incomplete()
    {
        $this->update(['completed' => false]);
        $this->recordsActivity('uncompleted_task');
    }

}
