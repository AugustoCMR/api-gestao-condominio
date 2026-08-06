<?php

namespace Tests\Feature\Condominium;

use App\Models\Condominium;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UpdateCondominiumTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_condominium(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['*']);

        $condominium = Condominium::factory()->create();

        $response = $this->patchJson(
            "api/condominium/{$condominium->uuid}",
            $this->payload()
        );

        $response->assertOk()->assertJsonPaths(['uuid' => $condominium->uuid, 'name' => 'testeUpdate']);

        $this->assertDatabaseHas('condominiums', [
            'name' => 'testeUpdate',
            'uuid' => $condominium->uuid
        ]);
    }

    private function payload(): array
    {
        return [
            'name' => 'testeUpdate'
        ];
    }
}
