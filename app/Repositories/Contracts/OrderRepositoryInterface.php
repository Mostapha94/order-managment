<?php
namespace App\Repositories\Contracts;
use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface OrderRepositoryInterface {
    public function paginateByUser(int $userId, int $perPage = 15): LengthAwarePaginator;
    public function findForUser(int $orderId, int $userId): ?Order;
    public function create(array $data): Order;
    public function update(Order $order, array $data): Order;
    public function delete(Order $order): void;
}
