<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;
class authTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

     /** @test */
     public function login_cradential_validation(){
        $this->json('POST', 'api/login')
        ->assertStatus(422)
        ->assertJson([
            'success' => false
        ]);
    }

    /**@test */
    public function testUserLoginsSuccessfully()
    {
        $user = factory(User::class)->create([
            'email' => 'test@test.com',
            'password' => bcrypt('123456'),
        ]);

        $payload = ['email' => 'test@test.com', 'password' => '123456'];

        $this->json('POST', 'api/login', $payload)
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

    }
}
