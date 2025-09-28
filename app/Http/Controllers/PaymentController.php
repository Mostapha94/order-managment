<?php
namespace App\Http\Controllers;
use App\Http\Requests\Payments\ProcessPaymentRequest;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Services\Payments\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller {
    protected $payments;
    protected $orders;
    protected $service;

    public function __construct(PaymentRepositoryInterface $payments, OrderRepositoryInterface $orders, PaymentService $service){
        $this->middleware('auth:api');
        $this->payments = $payments;
        $this->orders = $orders;
        $this->service = $service;
    }

    public function index(Request $req){
        $perPage = intval($req->query('per_page',15));
        return $this->payments->paginateByUser(auth()->id(), $perPage);
    }

    public function show($id){
        $payment = $this->payments->find($id);
        if (!$payment || $payment->order->user_id !== auth()->id()) return response()->json(['error'=>'Not found'], 404);
        return $payment;
    }

    public function process(ProcessPaymentRequest $req, $orderId){
        $order = $this->orders->findForUser($orderId, auth()->id());
        if (!$order) return response()->json(['error'=>'Not found'], 404);
        $payment = $this->service->process($order, $req->method, $req->payload ?? []);
        return response()->json($payment, 201);
    }
}
