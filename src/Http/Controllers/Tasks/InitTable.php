<?php

namespace LaravelLiberu\Tasks\Http\Controllers\Tasks;

use Illuminate\Routing\Controller;
use LaravelLiberu\Tables\Traits\Init;
use LaravelLiberu\Tasks\Tables\Builders\Task;

class InitTable extends Controller
{
    use Init;

    protected string $tableClass = Task::class;
}
