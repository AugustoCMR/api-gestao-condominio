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

        $response = $this->getJson(route('condominium.index', absolute: false));

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
            'links' => [
                'first',
                'last',
                'prev',
                'next',
            ],
            'meta' => [
                'current_page',
                'per_page',
                'from',
                'to',
                'last_page',
                'total',
                'path',
                'links',
            ],
        ]);

        $response->assertJsonCount(20, 'data');

        $response->assertJsonPath('meta.total', 25);
        $response->assertJsonPath('meta.per_page', 20);
        $response->assertJsonPath('meta.current_page', 1);
        $response->assertJsonPath('meta.last_page', 2);
    }

    public function test_get_condominiums_returns_remaining_items_on_second_page(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['*']);

        Condominium::factory()->count(25)->create();

        $response = $this->getJson(route('condominium.index', ['page' => 2], absolute: false));

        $response->assertOk();

        $response->assertJsonCount(5, 'data');

        $response->assertJsonPath('meta.current_page', 2);
    }

    public function test_get_condominiums_returns_empty_data_when_there_are_no_condominiums(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['*']);

        $response = $this->getJson(route('condominium.index', absolute: false));

        $response->assertOk();

        $response->assertJsonIsArray('data');

        $response->assertJsonCount(0, 'data');

        $response->assertJsonPath('meta.total', 0);
    }

    public function test_guest_cannot_get_condominiums(): void
    {
        $response = $this->getJson(route('condominium.index', absolute: false));

        $response->assertUnauthorized();
    }
}
