<?php

namespace LaravelLiberu\Tasks\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use LaravelLiberu\Tasks\Enums\Flags;
use LaravelLiberu\Tasks\Models\Task;
use LaravelLiberu\Users\Models\User;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        $reminder = $this->faker->boolean ? $this->faker->dateTimeBetween('-30 days', '+30 days') : null;
        $user = User::first();

        return [
            'name'         => $this->faker->name,
            'description'  => $this->faker->text,
            'flag'         => $this->faker->boolean ? Flags::keys()->random() : null,
            'completed'    => $this->faker->boolean,
            'reminder'     => $reminder,
            'allocated_to' => $user->id,
            'created_by'   => $user->id,
            'updated_by'   => $user->id,
            'reminded_at'  => $reminder && $this->faker->boolean ? $this->faker->dateTimeBetween($reminder, Carbon::createFromTimestamp($reminder->getTimestamp())->addMinute()) : null,
        ];
    }
}
