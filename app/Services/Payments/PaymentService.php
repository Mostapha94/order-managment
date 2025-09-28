<?php
namespace App\Services\Payments;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Arr;

class PaymentService {
    public function getGateway(string $key) {
        $map = config('payment_gateways.gateways', []);
        if (!isset($map[$key])) throw new \InvalidArgumentException("Gateway [$key] not configured.");
        return app($map[$key]);
    }

    public function process(Order $order, string $method, array $data = []): Payment {
        if ($order->status !== 'confirmed') {
            throw new \DomainException('Payments can only be processed for confirmed orders.');
        }
        $gateway = $this->getGateway($method);
        $result = $gateway->process($order, $data);
        $payment = Payment::create([
            'payment_id' => Arr::get($result,'payment_id','int_'.uniqid()),
            'order_id' => $order->id,
            'status' => Arr::get($result,'status','pending'),
            'method' => $method,
            'payload' => Arr::get($result,'payload', []),
        ]);
        return $payment->refresh();
    }
}
