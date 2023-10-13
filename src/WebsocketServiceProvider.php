<?php

namespace LaravelLiberu\Tasks;

use LaravelLiberu\Core\Facades\Websockets;
use LaravelLiberu\Core\WebsocketServiceProvider as CoreServiceProvider;
use LaravelLiberu\Users\Models\User;

class WebsocketServiceProvider extends CoreServiceProvider
{
    public function boot()
    {
        Websockets::register([
            'task' => fn (User $user) => 'tasks.'.$user->id,
        ]);
    }
}
