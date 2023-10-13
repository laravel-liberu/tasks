<?php

namespace LaravelLiberu\Tasks\Http\Controllers\Tasks;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelLiberu\Tasks\Forms\Builders\Task;
use LaravelLiberu\Tasks\Models\Task as Model;

class Edit extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Model $task, Task $form)
    {
        $this->authorize('handle', $task);

        return ['form' => $form->edit($task)];
    }
}
