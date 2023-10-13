<?php

namespace LaravelLiberu\Tasks\Contracts;

use Carbon\Carbon;
use LaravelLiberu\Users\Models\User;

interface Taskable
{
    public function name(): string;

    public function description(): string;

    public function allocatedTo(): ?User;

    public function createdBy(): ?User;

    public function updatedBy(): ?User;

    public function reminder(): Carbon;

    public function flag(): ?int;

    public function completed(): bool;
}
