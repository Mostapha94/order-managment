<?php
namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Order;

class PaymentTest extends TestCase {
    use RefreshDatabase;
    protected function authenticate(){
        $user = User::factory()->create(['password'=>bcrypt('secret')]);
        $token = auth()->login($user);
        return [$user, 'Authorization' => 'Bearer '.$token];
    }

    public function test_payment_workflow(){
        [$user, $headers] = $this->authenticate();
        $order = Order::create(['user_id'=>$user->id,'status'=>'confirmed','total'=>50]);
        $payload = ['method'=>'fake','payload'=>[]];
        $this->postJson('/api/orders/'.$order->id.'/payments', $payload, $headers)->assertStatus(201)->assertJsonFragment(['method'=>'fake']);
    }
}
