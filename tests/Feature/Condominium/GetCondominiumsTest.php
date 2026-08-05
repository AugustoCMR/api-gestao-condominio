<?php

namespace Tests\Feature\Condominium;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GetCondominiumsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_condominiums(): void
    {   
        Sanctum::actingAs(User::factory()->create(), ['*']);

        $response = $this->getJson('/api/condominium');

        $response->assertStatus(200);

        $response->assertJsonIsArray();

        $response->assertJsonStructure([
            '*' => [
                'uuid',
                'name',
                'cnpj',
                'address',
                'phone',
                'complement',
                'neighborhood',
                'city',
                'state',
                'zip_code',
                'email',
            ],
        ]);
    }
}
