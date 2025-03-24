<?php

namespace App\Policies;

use App\Helpers\FormatResponse;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{

    /**
     * Determine whether the user can permanently delete the model.
     */


    public function modify(User $user, Task $task): Response
    {
       
        return $user->id === $task->user_id ? Response::allow() :  Response::deny('you are not authorized to update/delete a post') ;
    }

   
}
