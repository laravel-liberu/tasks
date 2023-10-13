<?php

namespace LaravelLiberu\Tasks\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use LaravelLiberu\Tasks\Models\Task as Model;
use LaravelLiberu\Users\Models\User;

class Task
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->isAdmin() || $user->isSupervisor()) {
            return true;
        }
    }

    public function handle(User $user, Model $task)
    {
        return $user->id === $task->created_by;
    }

    public function allocate()
    {
        return false;
    }
}
