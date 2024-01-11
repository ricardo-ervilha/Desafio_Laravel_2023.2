<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic unit test example.
     */

    /** @test */
    public function unauthorized_people_cannot_update_the_user(): void
    {
        $this->actingAs(\App\Models\User::factory()->create());

        $user = \App\Models\User::factory()->create();
        $user->name = 'Mohammed Salah';

        $response = $this->post('/users/edit/'.$user->id, $user->toArray());

        //Espera-se um status de 403 indicando erro por não possuir autorização.
        $response->assertStatus(403);
    }

    /** @test  */
    public function authorized_people_can_update_the_user()
    {
        $this->actingAs(\App\Models\User::factory()->create([
            'isAdmin' => true
        ]));

        $user = \App\Models\User::factory()->create();
        $user->name = 'Mohammed Salah';

        $this->post('/users/edit/'.$user->id, $user->toArray());

        $this->assertDatabaseHas('users', ['id' => $user->id, 'name' => 'Mohammed Salah']);
    }
}
