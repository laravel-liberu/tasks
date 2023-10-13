<?php

namespace LaravelLiberu\Tasks\Http\Controllers\Tasks;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelLiberu\Tasks\Http\Requests\ValidateTask;
use LaravelLiberu\Tasks\Models\Task;

class Update extends Controller
{
    use AuthorizesRequests;

    public function __invoke(ValidateTask $request, Task $task)
    {
        $this->authorize('handle', $task);

        $task->fill($request->validated());

        if ($task->isDirty('allocated_to')) {
            $this->authorize('allocate', $task);
        }

        $task->save();

        return ['message' => __('The task was successfully updated')];
    }
}
