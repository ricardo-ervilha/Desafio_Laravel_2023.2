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
        $this->withoutMiddleware();

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
    public function a_user_can_read_single_owner() : void{

        $this->withoutMiddleware();

        //Testa o método 'Show'
        $owner = Owner::factory()->create();

        $response = $this->get('/owners/'.$owner->id);

        $response->assertSee($owner->name)
            ->assertSee($owner->email)
//            ->assertSee($owner->cpf) //Descomente isso para mostrar o erro ao rodar os testes!
            ->assertSee($owner->dateBirth);
    }

    /** @test */
    public function authenticated_users_can_create_a_new_owner() : void{

        //Testa o método store

        //Dado que temos um usuário já autenticado
        $this->actingAs(\App\Models\User::factory()->create());

        //E os dados do formulário
        $data = [
            'name' => 'Maxuel Nunes',
            'email' => 'macsuelsSelvagem@example.com',
            'dateBirth' => '2002-03-25',
            'phone' => '(32) 91234-5678',
            'cpf' => '827.501.450-66',
            'cep' => '36530-000',
            'publicPlace' => 'Rua das Orquideas Amarelas',
            'district' => 'Bairro São Pedro',
            'uf' => 'MG',
            'city' => 'Juiz de Fora',
            'num' => '71'
        ];

        //Usuário submete um post request para criar um owner
        $this->post('/owners/store', $data);

        //Ele é armazenado na database
        $this->assertEquals(1, Owner::all()->count());
    }

    /** @test */
    public function unauthenticated_users_cannot_create_a_new_owner()
    {
        //Dado que temos os dados de um owner
        $data = [
            'name' => 'Maxuel Nunes',
            'email' => 'macsuelsSelvagem@example.com',
            'dateBirth' => '2002-03-25',
            'phone' => '(32) 91234-5678',
            'cpf' => '827.501.450-66',
            'cep' => '36530-000',
            'publicPlace' => 'Rua das Orquideas Amarelas',
            'district' => 'Bairro São Pedro',
            'uf' => 'MG',
            'city' => 'Juiz de Fora',
            'num' => '71'
        ];

        //Quando um usuário não autenticado submete um post request para criar um owner no end point
        //Ele será redirecionado para a página de login
        $this->post('/owners/store', $data)
            ->assertRedirect('/login');
    }

    /** @test */
    public function a_owner_requires_a_name()
    {
        $this->actingAs(\App\Models\User::factory()->create());

        $data = [
            'name' => null,
            'email' => 'macsuelsSelvagem@example.com',
            'dateBirth' => '2002-03-25',
            'phone' => '(32) 91234-5678',
            'cpf' => '827.501.450-66',
            'cep' => '36530-000',
            'publicPlace' => 'Rua das Orquideas Amarelas',
            'district' => 'Bairro São Pedro',
            'uf' => 'MG',
            'city' => 'Juiz de Fora',
            'num' => '71'
        ];

        $this->post('/owners/store', $data)
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function authenticated_user_can_update_the_owner()
    {
        //Dado uqe temos um usuário logado
        $this->actingAs(\App\Models\User::factory()->create());

        //E um owner o qual foi criado pelo usuário
        $data = [
            'name' => 'Maxuel da SIlva Nunes',
            'email' => 'macsuelsSelvagem@example.com',
            'dateBirth' => '2002-03-25',
            'phone' => '(32) 91234-5678',
            'cpf' => '827.501.450-66',
            'cep' => '36530-000',
            'publicPlace' => 'Rua das Orquideas Amarelas',
            'district' => 'Bairro São Pedro',
            'uf' => 'MG',
            'city' => 'Juiz de Fora',
            'num' => '71'
        ];
        $this->post('/owners/store', $data);

        $maxuel = Owner::all()->first();
        $maxuel->name = "Tchutchucão";

        $this->post('/owners/edit/'.$maxuel->id, $maxuel->toArray());

        $this->assertDatabaseHas('owners', ['id' => $maxuel->id, 'name' => 'Tchutchucão']);
    }

    /** @test */
    public function authenticated_user_can_delete_the_owner()
    {
        //Usuário logado
        $this->actingAs(\App\Models\User::factory()->create());

        $owner = Owner::factory()->create();

        $this->post('/owners/delete/'.$owner->id);

        $this->assertDatabaseMissing('owners', ['id' => $owner->id]);
    }
}
