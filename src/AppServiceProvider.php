<?php

namespace LaravelLiberu\Tasks;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use LaravelLiberu\DynamicMethods\Services\Methods;
use LaravelLiberu\Tasks\Commands\SendTaskReminders;
use LaravelLiberu\Tasks\DynamicRelations\Tasks;
use LaravelLiberu\Tasks\Models\Task as Model;
use LaravelLiberu\Tasks\Observers\Task as Observer;
use LaravelLiberu\Users\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->load()
            ->publish()
            ->command()
            ->relations()
            ->observers();
    }

    private function load(): self
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->mergeConfigFrom(__DIR__.'/../config/tasks.php', 'enso.tasks');

        return $this;
    }

    private function publish(): self
    {
        $this->publishes([
            __DIR__.'/../config' => config_path('enso'),
        ], ['enso-config', 'tasks-config']);

        $this->publishes([
            __DIR__.'/../client/src/js' => base_path('client/src/js'),
        ], 'tasks-assets');

        return $this;
    }

    private function command(): self
    {
        $this->commands(SendTaskReminders::class);

        $this->app->booted(fn () => $this->app->make(Schedule::class)
            ->command('enso:tasks:send-reminders')->everyMinute());

        return $this;
    }

    private function relations(): self
    {
        Methods::bind(User::class, [Tasks::class]);

        return $this;
    }

    private function observers()
    {
        Model::observe(Observer::class);
    }
}
