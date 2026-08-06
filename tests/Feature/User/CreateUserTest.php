<?php

namespace Tests\Feature\User;

use Tests\TestCase;

class CreateUserTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_create_user(): void
    {
        $response = $this->postJson(route('user.register', absolute: false), [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password',
        ]);

        $response->assertCreated()
            ->assertJsonMissingPath('password');

        $this->assertDatabaseHas('users', [
            'email' => 'john.doe@example.com',
        ]);
    }
}
