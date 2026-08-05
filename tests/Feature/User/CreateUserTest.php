<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_create_user(): void
    {
        $response = $this->postJson('/api/user/register', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password'
        ]);

        $response->assertCreated()
        ->assertJsonMissingPath('password');

        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@example.com',
        ]);
    }
}
