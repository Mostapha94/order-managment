<?php
namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class OrderTest extends TestCase {
    use RefreshDatabase;
    protected function authenticate(){
        $user = User::factory()->create(['password'=>bcrypt('secret')]);
        $token = auth()->login($user);
        return ['Authorization' => 'Bearer '.$token];
    }

    public function test_create_order(){
        $headers = $this->authenticate();
        $payload = [
            'items' => [
                ['product_name'=>'A','quantity'=>2,'price'=>10],
                ['product_name'=>'B','quantity'=>1,'price'=>5],
            ]
        ];
        $this->postJson('/api/orders', $payload, $headers)->assertStatus(201)->assertJsonFragment(['total'=>25]);
    }
}
