<?php

namespace LaravelLiberu\Tasks\DynamicRelations;

use Closure;
use LaravelLiberu\DynamicMethods\Contracts\Method;
use LaravelLiberu\Tasks\Models\Task;

class Tasks implements Method
{
    public function name(): string
    {
        return 'tasks';
    }

    public function closure(): Closure
    {
        return fn () => $this->hasMany(Task::class, 'allocated_to');
    }
}
