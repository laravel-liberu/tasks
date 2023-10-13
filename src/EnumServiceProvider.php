<?php

namespace LaravelLiberu\Tasks;

use LaravelLiberu\Enums\EnumServiceProvider as ServiceProvider;
use LaravelLiberu\Tasks\Enums\Flags;

class EnumServiceProvider extends ServiceProvider
{
    public $register = [
        'flags' => Flags::class,
    ];
}
