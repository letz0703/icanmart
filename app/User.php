<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //'isAdmin' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function boxes()
    {
        return $this->hasMany(Box::class)->latest();
    }

    public function isAdmin()
    {
        //return in_array($this->name,['rainskiss']);
        return in_array(auth()->user()->email, [env('ADMIN_EMAIL')]);
         //return ['rainskiss', 'letz0703'].includes(user.name);
    }

    public function projects()
    {
        return $this->hasMany(Project::class,'owner_id')
                    ->latest('updated_at');
    }

    public function accessibleProjects()
    {
        return Project::where('owner_id',$this->id)
            ->orWhereHas('members', function($query){
                $query->where('user_id', $this->id);
            })->latest()->get();
        //$projectCreated = $this->projects;
        //$ids = \DB::table('project_members')->where('user_id',$this->id)->pluck('project_id');
        //
        //$projectInvited = Project::find($ids);
        //
        //return $projectCreated->merge($projectInvited);
    }


}
