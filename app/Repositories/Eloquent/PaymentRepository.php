<?php
namespace App\Repositories\Eloquent;
use App\Models\Payment;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PaymentRepository implements PaymentRepositoryInterface {
    public function paginateByUser(int $userId, int $perPage = 15): LengthAwarePaginator {
        return Payment::whereHas('order', function($q) use ($userId){ $q->where('user_id', $userId); })->paginate($perPage);
    }
    public function find(int $id): ?Payment { return Payment::find($id); }
    public function create(array $data): Payment { return Payment::create($data); }
}
