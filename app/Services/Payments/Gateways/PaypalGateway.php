<?php
namespace App\Services\Payments\Gateways;
use App\Models\Order;

class PaypalGateway implements PaymentGatewayInterface {
    public function key(): string { return 'paypal'; }
    public function process(Order $order, array $data = []): array {
        // A stub demonstrating how a real gateway would be wired
        return [
            'payment_id' => 'paypal_'.uniqid(),
            'status' => 'successful',
            'payload' => ['stub' => true, 'received' => $data],
        ];
    }
}
