<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_login_user(): void
    {
        $user = User::factory()->create([
            'name' => 'condominioteste',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('0000'),
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => 'john.doe@example.com',
            'password' => '0000',
        ]);

        $response->assertOk()
            ->assertJsonStructure([
                'sub',
                'name',
                'access_token',
                'refresh_token',
            ])
            ->assertJsonPath('sub', $user->uuid)
            ->assertJsonMissingPath('password');
    }
}
