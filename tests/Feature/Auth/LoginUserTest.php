<?php

namespace Tests\Feature\Auth;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginUserTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_login_user(): void
    {
        $response = $this->postJson('/api/auth/login', [
            'name' => 'CondominioTeste',
            'password' => '0000'
        ]);

        $response->assertStatus(200);
    }
}
