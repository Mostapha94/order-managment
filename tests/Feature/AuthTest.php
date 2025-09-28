<?php
namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase {
    use RefreshDatabase;
    public function test_register_and_login(){
        $payload = [
            'name'=>'Test User',
            'email'=>'test@example.com',
            'password'=>'secret123',
            'password_confirmation'=>'secret123'
        ];
        $this->postJson('/api/register', $payload)->assertStatus(201)->assertJsonStructure(['user','token']);
        $login = $this->postJson('/api/login', ['email'=>'test@example.com','password'=>'secret123'])->assertStatus(200)->assertJsonStructure(['token']);
    }
}
