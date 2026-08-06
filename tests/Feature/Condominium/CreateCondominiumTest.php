<?php

namespace Tests\Feature\Condominium;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreateCondominiumTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_condominium(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['*']);

        $response = $this->postJson(route('condominium.store', absolute: false), $this->validPayload());

        $response->assertCreated();

        $this->assertDatabaseHas('condominiums', [
            'cnpj' => '12345678911111',
            'email' => 'contato@condominioteste.com.br',
        ]);
    }

    public function test_guest_cannot_create_condominium(): void
    {
        $response = $this->postJson(route('condominium.store', absolute: false), $this->validPayload());

        $response->assertUnauthorized();

        $this->assertDatabaseCount('condominiums', 0);
    }

    /**
     * @return array<string, string>
     */
    private function validPayload(): array
    {
        return [
            'name' => 'Condomínio Teste',
            'address' => 'Rua Teste, 123',
            'city' => 'Cidade Teste',
            'state' => 'Estado Teste',
            'zip_code' => '12345-678',
            'cnpj' => '12345678911111',
            'phone' => '(11) 1234-5678',
            'email' => 'contato@condominioteste.com.br',
            'neighborhood' => 'Teste',
            'complement' => 'Apto 101',
        ];
    }
}
