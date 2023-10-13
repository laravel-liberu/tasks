<?php

namespace LaravelLiberu\Tasks\Http\Controllers\Tasks;

use Illuminate\Support\Facades\Config;
use LaravelLiberu\Users\Http\Controllers\Options;

class Users extends Options
{
    public function query()
    {
        $roles = Config::get('enso.tasks.roles');

        return parent::query()
            ->when($roles !== ['*'], fn ($query) => $query
                ->whereIn('role_id', $roles));
    }
}
