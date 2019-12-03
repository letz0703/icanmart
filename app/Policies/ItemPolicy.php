<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;
    
    //public function viewAny(User $user)
    //{
    //    return false;
    //}
    
    public function update(User $user, Item $item)
    {
        return $item->user_id == $user->id;
    }
    
}
