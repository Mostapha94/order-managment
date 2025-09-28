<?php
namespace App\Repositories\Eloquent;
use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class OrderRepository implements OrderRepositoryInterface {
    public function paginateByUser(int $userId, int $perPage = 15): LengthAwarePaginator {
        return Order::with('items','payments')->where('user_id', $userId)->paginate($perPage);
    }
    public function findForUser(int $orderId, int $userId): ?Order {
        return Order::with('items','payments')->where('id', $orderId)->where('user_id', $userId)->first();
    }
    public function create(array $data): Order { return Order::create($data); }
    public function update(Order $order, array $data): Order { $order->update($data); return $order->refresh(); }
    public function delete(Order $order): void { $order->delete(); }
}
