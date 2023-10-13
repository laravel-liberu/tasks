<?php

namespace LaravelLiberu\Tasks\Enums;

use LaravelLiberu\Enums\Services\Enum;

class Flags extends Enum
{
    public const Danger = 1;
    public const Warning = 2;
    public const Info = 3;
    public const Success = 4;
}
