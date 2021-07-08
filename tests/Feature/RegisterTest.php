<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function guest_can_register_as_patient(){
        $payload = [
            'name' => 'patient',
            'email' => 'patient2222@gmail.com',
            'password' => '123456',
            'password_confirmation' => '123456',
        ];
        $this->json('post', '/api/register', $payload)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'token',
                    'name',
                ],
            ]);
    }
}
