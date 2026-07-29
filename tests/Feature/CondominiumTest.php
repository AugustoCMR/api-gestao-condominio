<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CondominiumTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_condominium(): void
    {
        $response = $this->postJson('/api/condominiums', [
            'name' => 'Condomínio Teste',
            'address' => 'Rua Teste, 123',
            'city' => 'Cidade Teste',
            'state' => 'Estado Teste',
            'zip_code' => '12345-678',
            'cnpj' => '12.345.678/0001-90',
            'phone' => '(11) 1234-5678',
            'email' => 'contato@condominioteste.com.br'
        ]);

        $response->assertCreated();
    }
}
