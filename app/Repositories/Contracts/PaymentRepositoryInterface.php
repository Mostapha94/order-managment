<?php
namespace App\Repositories\Contracts;
use App\Models\Payment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PaymentRepositoryInterface {
    public function paginateByUser(int $userId, int $perPage = 15): LengthAwarePaginator;
    public function find(int $id): ?Payment;
    public function create(array $data): Payment;
}
