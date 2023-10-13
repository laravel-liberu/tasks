<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use LaravelLiberu\Users\Models\User;
use Tests\TestCase;

class AllocateToRolesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->actingAs(User::first());
    }

    /** @test */
    public function can_limit_roles()
    {
        Config::set('liberu.tasks.roles', []);

        $this->get(route('tasks.users'))->assertJson([]);
    }

    /** @test */
    public function can_select_all_roles()
    {
        Config::set('liberu.tasks.roles', ['*']);

        $this->get(route('tasks.users'))->assertJsonCount(User::count());
    }
}
