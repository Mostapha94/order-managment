<?php
namespace Tests\Unit;
use PHPUnit\Framework\TestCase;
use App\Services\Payments\Gateways\FakeGateway;
use App\Models\Order;

class PaymentGatewayTest extends TestCase {
    public function test_fake_gateway_process(){
        $order = new Order(['total'=>10]);
        $gateway = new FakeGateway();
        $res = $gateway->process($order, []);
        $this->assertArrayHasKey('payment_id', $res);
        $this->assertArrayHasKey('status', $res);
    }
}
