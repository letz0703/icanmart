<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use function class_basename;

class Project extends Model
{
    use RecordsActivity;

    protected $guarded = [];


    public function path()
    {
        return "/projects/{$this->id}";
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }


    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'project_members')
            ->withTimestamps();
    }

    public function invite(User $user)
    {
        return $this->members()->attach($user);
    }


    public function addTask($body)
    {
        return $this->tasks()->create(['body'=>$body]);
    }

    public function addTasks($tasks)
    {
        return $this->tasks()->createMany($tasks);
    }


}
