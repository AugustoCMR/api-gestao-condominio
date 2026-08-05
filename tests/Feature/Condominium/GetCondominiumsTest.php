<?php

namespace Tests\Feature\Condominium;

use App\Models\Condominium;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GetCondominiumsTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_condominiums_returns_paginated_list(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['*']);

        Condominium::factory()->count(25)->create();

        $response = $this->getJson('/api/condominium');

        $response->assertOk();

        $response->assertJsonIsArray('data');

        $response->assertJsonStructure([
            'data' => [
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
            ],
            'current_page',
            'per_page',
            'from',
            'to',
            'last_page',
            'total',
            'first_page_url',
            'last_page_url',
            'next_page_url',
            'prev_page_url',
            'path',
            'links',
        ]);

        $response->assertJsonCount(20, 'data');

        $response->assertJsonPath('total', 25);
        $response->assertJsonPath('per_page', 20);
        $response->assertJsonPath('current_page', 1);
        $response->assertJsonPath('last_page', 2);
    }

    public function test_get_condominiums_returns_remaining_items_on_second_page(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['*']);

        Condominium::factory()->count(25)->create();

        $response = $this->getJson('/api/condominium?page=2');

        $response->assertOk();

        $response->assertJsonCount(5, 'data');

        $response->assertJsonPath('current_page', 2);
    }

    public function test_get_condominiums_returns_empty_data_when_there_are_no_condominiums(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['*']);

        $response = $this->getJson('/api/condominium');

        $response->assertOk();

        $response->assertJsonIsArray('data');

        $response->assertJsonCount(0, 'data');

        $response->assertJsonPath('total', 0);
    }

    public function test_guest_cannot_get_condominiums(): void
    {
        $response = $this->getJson('/api/condominium');

        $response->assertUnauthorized();
    }
}
