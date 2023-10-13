<?php

namespace LaravelLiberu\Tasks\Http\Controllers\Tasks;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelLiberu\Tasks\Models\Task;

class Destroy extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Task $task)
    {
        $this->authorize('handle', $task);

        $task->delete();

        return [
            'message'  => __('The task was successfully deleted'),
            'redirect' => 'tasks.index',
        ];
    }
}
