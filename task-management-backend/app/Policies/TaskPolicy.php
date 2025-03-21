<?php

namespace App\Policies;

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
        return $user->id === $task->user_id ? Response::allow() : Response::deny('you are not authorized to delete a post');
    }

    public function view(User $user, Task $task): Response
    {

        return $user->id === $task->user_id ? Response::allow() : Response::deny("you are not authorized");
    }
}
