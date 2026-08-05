<?php

namespace Tests\Feature\Condominium;

use App\Models\Condominium;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DeleteCondominiumTest extends TestCase
{
    use RefreshDatabase;

    public function test_delete_condominium(): void
    {
        Sanctum::actingAs(User::factory()->create(), ['*']);

        $condominium = Condominium::factory()->create();

        $response = $this->deleteJson("/api/condominium/{$condominium->uuid}");

        $response->assertNoContent();

        $this->assertDatabaseMissing('condominiums', ['uuid' => $condominium->uuid]);
    }
}
