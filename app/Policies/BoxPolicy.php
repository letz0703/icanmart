<?php

namespace App\Policies;

use App\User;
use App\Box;
use Illuminate\Auth\Access\HandlesAuthorization;

class BoxPolicy
{
    use HandlesAuthorization;
    
    //public function before($user)
    //{
    //    if ($user->name === 'rainskiss'){
    //        return true;
    //    }
    //}
    
    
    /**
     * Determine whether the user can view the box.
     *
     * @param  \App\User  $user
     * @param  \App\Box  $box
     * @return mixed
     */
    public function view(User $user, Box $box)
    {
        return $user->email === env('ADMIN_EMAIL');
    }

    /**
     * Determine whether the user can create boxes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the box.
     *
     * @param  \App\User  $user
     * @param  \App\Box  $box
     * @return mixed
     */
    public function update(User $user, Box $box)
    {
        //return $box->user_id == $user->id;
        return $user->isAdmin();
    }
    
    /**
     * Determine whether the user can delete the box.
     *
     * @param  \App\User  $user
     * @param  \App\Box  $box
     * @return mixed
     */
    public function delete(User $user, Box $box)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the box.
     *
     * @param  \App\User  $user
     * @param  \App\Box  $box
     * @return mixed
     */
    public function restore(User $user, Box $box)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the box.
     *
     * @param  \App\User  $user
     * @param  \App\Box  $box
     * @return mixed
     */
    public function forceDelete(User $user, Box $box)
    {
        //
    }
}
