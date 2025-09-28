<?php
namespace App\Services\Payments\Gateways;
use App\Models\Order;

interface PaymentGatewayInterface {
    public function process(Order $order, array $data = []): array;
    public function key(): string;
}
