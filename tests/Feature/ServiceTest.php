<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Service;

class ServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_admin_can_create_service(){
        $user = User::factory()->create();
        $user->assignRole('admin');
        $token = $user->createToken('MyAuthApp')->plainTextToken; 
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'name_en' => 'service1',
            'name_ar' => 'خدمة1',
            'description_en'=>'description1',
            'description_ar'=>'وصف1'
        ];

        $this->json('POST', '/api/v1/admin/services', $payload, $headers)
            ->assertStatus(200)
            ->assertJson(["data"=>['id' => 1, 'name' => 'service1']]);
    }

    public function test_admin_can_update_service(){
        $user = User::factory()->create();
        $user->assignRole('admin');
        $token = $user->createToken('MyAuthApp')->plainTextToken; 
        $headers = ['Authorization' => "Bearer $token"];
        $service = Service::factory()->create();
        $payload = [
            'name_en' => 'service1 updated',
            'name_ar' => 'خدمة1',
            'description_en'=>'description1 updated',
            'description_ar'=>'وصف1'
        ];

        $response = $this->json('PUT', '/api/v1/admin/services/' . $service->id, $payload, $headers)
            ->assertStatus(200)
    }

    public function test_admin_list_services(){
        $user = User::factory()->create();
        $user->assignRole('admin');
        $token = $user->createToken('MyAuthApp')->plainTextToken; 
        $headers = ['Authorization' => "Bearer $token"];
        $service = Service::factory()->create();
        $response = $this->json('GET', '/api/v1/admin/services/', [],$headers)
            ->assertJson(["status"=>200]);
    }

    public function test_admin_delete_service(){
        $user = User::factory()->create();
        $user->assignRole('admin');
        $token = $user->createToken('MyAuthApp')->plainTextToken; 
        $headers = ['Authorization' => "Bearer $token"];
        $service = Service::factory()->create();

        $this->json('DELETE', '/api/v1/admin/services/' . $service->id, [], $headers)
            ->assertStatus(200);
    }
}
