<?php


use App\Modules\Customer\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('pode listar clientes', function () {
    Customer::factory()->count(3)->create();

    $response = $this->getJson('/api/customers');

    $response->assertStatus(200);
});

it('pode criar um cliente', function () {
    $dados = [
        'name' => 'Marcio Silva',
        'email' => 'marcio@email.com'
    ];

    $response = $this->postJson('/api/customers', $dados);

    $response->assertStatus(201);
    $this->assertDatabaseHas('customers', ['email' => 'marcio@email.com']);
});

it('não pode criar um cliente com e-mail inválido', function () {
    $customer = ['name' => 'Marcio', 'email' => 'marcio.com'];
    $response = $this->postJson('/api/customers', $customer);
    $response->assertStatus(422);
});

it('retorna 404 quando o cliente não existe', function () {
    $response = $this->getJson('/api/customers/id-que-nao-existe');

    $response->assertStatus(404);
});

it('pode atualizar um cliente', function () {
    $customer = Customer::factory()->create();

    $response = $this->putJson("/api/customers/{$customer->id}", [
        'name' => 'Nome Atualizado',
        'email' => $customer->email
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseHas('customers', ['name' => 'Nome Atualizado']);
});

it('pode deletar um cliente', function () {
    $customer = Customer::factory()->create();

    $response = $this->deleteJson("/api/customers/{$customer->id}");

    $response->assertStatus(204);
    $this->assertDatabaseMissing('customers', ['id' => $customer->id]);
});

it('pode buscar cliente por id', function () {
    $customer = Customer::factory()->create();

    $response = $this->getJson("/api/customers/{$customer->id}");

    $response->assertStatus(200)
        ->assertJsonFragment(['email' => $customer->email]);
});
