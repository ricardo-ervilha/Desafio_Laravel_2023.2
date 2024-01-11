<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\Owner;

class OwnerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic unit test example.
     */
    /** @test */
    public function a_user_can_read_all_owner_informations(): void
    {
        //Testa o método 'index'
        $owner = Owner::factory()->create();

        $response = $this->get('/owners');

        $response->assertSee($owner->name);
        $response->assertSee($owner->email);
        $response->assertSee($owner->dateBirth);
        $response->assertSee($owner->phone);
        $response->assertSee($owner->cpf);
    }

    /** @test */
    public function a_user_can_read_single_task() : void{
        //Testa o método 'Show'
        $owner = Owner::factory()->create();

        $response = $this->get('/owners/'.$owner->id);

        $response->assertSee($owner->name)
            ->assertSee($owner->email)
            ->assertSee($owner->dateBirth);
    }
}
