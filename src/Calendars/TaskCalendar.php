<?php

namespace LaravelLiberu\Tasks\Calendars;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use LaravelLiberu\Calendar\Contracts\CustomCalendar;
use LaravelLiberu\Calendar\Enums\Colors;
use LaravelLiberu\Tasks\Models\Task;

class TaskCalendar implements CustomCalendar
{
    public function getKey()
    {
        return 'task-calendar';
    }

    public function name(): string
    {
        return 'Tasks';
    }

    public function color(): string
    {
        return Colors::Red;
    }

    public function private(): bool
    {
        return false;
    }

    public function readonly(): bool
    {
        return true;
    }

    public function events(Carbon $startDate, Carbon $endDate): Collection
    {
        return Task::visible()
            ->whereBetween('reminder', [$startDate, $endDate])->get()
            ->map(fn ($task) => new TaskEvent($task));
    }
}
