<?php
namespace App\Services\Payments\Gateways;
use App\Models\Order;

class FakeGateway implements PaymentGatewayInterface {
    public function key(): string { return 'fake'; }
    public function process(Order $order, array $data = []): array {
        // Simple deterministic behavior for tests:
        // orders with total < 1000 succeed, else pending
        $status = $order->total < 1000 ? 'successful' : 'pending';
        return [
            'payment_id' => 'fake_'.uniqid(),
            'status' => $status,
            'payload' => ['message' => 'Processed by fake gateway', 'input' => $data],
        ];
    }
}
