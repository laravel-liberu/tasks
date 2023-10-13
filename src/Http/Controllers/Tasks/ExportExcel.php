<?php

namespace LaravelLiberu\Tasks\Http\Controllers\Tasks;

use Illuminate\Routing\Controller;
use LaravelLiberu\Tables\Traits\Excel;
use LaravelLiberu\Tasks\Tables\Builders\Task;

class ExportExcel extends Controller
{
    use Excel;

    protected string $tableClass = Task::class;
}
