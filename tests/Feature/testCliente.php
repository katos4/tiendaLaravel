<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class testCliente extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/detallesProducto/6');
        $response->assertStatus(200)
        ->assertSee('Vegan Shawarma Wrap');
    }

    public function testPrueba(){
        $response = $this->get('/detallesProducto/4');
        $response->assertStatus(200)
        ->assertSee('Vegan Shawarma Wrap');
    }
}
