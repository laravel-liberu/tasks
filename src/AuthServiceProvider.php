<?php

namespace LaravelLiberu\Tasks;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use LaravelLiberu\Tasks\Models\Task;
use LaravelLiberu\Tasks\Policies\Task as Policy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Task::class => Policy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
