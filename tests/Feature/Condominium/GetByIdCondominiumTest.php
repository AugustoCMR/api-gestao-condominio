<?php

namespace Tests\Feature\Condominium;

use App\Models\Condominium;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GetByIdCondominiumTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_get_by_id_condominium(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['*']);

        $condominium = Condominium::factory()->create();

        $response = $this->getJson(route('condominium.show', $condominium->uuid, absolute: false));

        $response->assertOk();
        $response->assertJsonPath('uuid', $condominium->uuid);
    }
}
