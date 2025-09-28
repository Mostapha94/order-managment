<?php
namespace App\Http\Controllers;
use App\Http\Requests\Orders\StoreOrderRequest;
use App\Http\Requests\Orders\UpdateOrderRequest;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller {
    protected $orders;
    public function __construct(OrderRepositoryInterface $orders){
        $this->middleware('auth:api');
        $this->orders = $orders;
    }

    public function index(Request $req){
        $perPage = intval($req->query('per_page',15));
        return $this->orders->paginateByUser(auth()->id(), $perPage);
    }

    public function store(StoreOrderRequest $req){
        $data = $req->validated();
        $orderData = [
            'user_id' => auth()->id(),
            'status' => $data['status'] ?? 'pending',
            'meta' => $data['meta'] ?? null,
        ];
        $order = $this->orders->create($orderData);
        $total = 0;
        foreach ($data['items'] as $it){
            $line = $it['quantity'] * $it['price'];
            $order->items()->create([
                'product_name' => $it['product_name'],
                'quantity' => $it['quantity'],
                'price' => $it['price'],
                'line_total' => $line,
            ]);
            $total += $line;
        }
        $order->total = $total;
        $order->save();
        return response()->json($order->load('items','payments'), 201);
    }

    public function show($id){
        $order = $this->orders->findForUser($id, auth()->id());
        if (!$order) return response()->json(['error'=>'Not found'], 404);
        return $order;
    }

    public function update(UpdateOrderRequest $req, $id){
        $order = $this->orders->findForUser($id, auth()->id());
        if (!$order) return response()->json(['error'=>'Not found'], 404);
        $data = $req->validated();
        if (isset($data['items'])) {
            $order->items()->delete();
            $total = 0;
            foreach ($data['items'] as $it){
                $line = $it['quantity'] * $it['price'];
                $order->items()->create([
                    'product_name'=>$it['product_name'],
                    'quantity'=>$it['quantity'],
                    'price'=>$it['price'],
                    'line_total'=>$line,
                ]);
                $total += $line;
            }
            $data['total'] = $total;
        }
        $this->orders->update($order, $data);
        return $order->load('items','payments');
    }

    public function destroy($id){
        $order = $this->orders->findForUser($id, auth()->id());
        if (!$order) return response()->json(['error'=>'Not found'], 404);
        if ($order->payments()->exists()) return response()->json(['error'=>'Cannot delete order with payments'], 400);
        $this->orders->delete($order);
        return response()->json(null, 204);
    }
}
