<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_products_with_expected_json_structure()
    {
        Product::factory()->count(3)->create();

        $response = $this->getJson('/api/products');

        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'name',
                    'price',
                    'stock',
                    'status',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    /** @test */
    public function it_returns_500_if_database_fails()
    {
        DB::disconnect(); // corta la conexión activa
        Config::set('database.connections.pgsql.database', 'non_existing_db_name');

        $response = $this->getJson('/api/products');

        $response->assertStatus(500);
    }
}
