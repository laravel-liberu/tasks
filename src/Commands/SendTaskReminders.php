<?php

namespace LaravelLiberu\Tasks\Commands;

use Illuminate\Console\Command;
use LaravelLiberu\Tasks\Models\Task;

class SendTaskReminders extends Command
{
    protected $signature = 'enso:tasks:send-reminders';

    protected $description = 'Send tasks reminders';

    public function handle()
    {
        Task::with('allocatedTo')
            ->notReminded()
            ->overdue()
            ->get()->each->remind();
    }
}
