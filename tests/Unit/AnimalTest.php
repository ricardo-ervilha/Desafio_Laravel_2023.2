<?php

namespace Tests\Unit;

use App\Models\Owner;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Animal;

class AnimalTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic unit test example.
     */
    /** @test */
    public function a_user_can_read_all_animal_informations(): void
    {
        $animal = Animal::factory()->create();

        $response = $this->get('/animals');

        $response->assertSee($animal->name);
        $response->assertSee($animal->dateBirth);
        $response->assertSee($animal->species);
        $response->assertSee($animal->breed);
    }
}
