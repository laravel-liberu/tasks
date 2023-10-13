<?php

namespace LaravelLiberu\Tasks\Http\Controllers\Tasks;

use Illuminate\Routing\Controller;
use LaravelLiberu\Tables\Traits\Data;
use LaravelLiberu\Tasks\Tables\Builders\Task;

class TableData extends Controller
{
    use Data;

    protected string $tableClass = Task::class;
}
