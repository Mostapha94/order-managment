<?php
namespace App\Http\Requests\Orders;
use Illuminate\Foundation\Http\FormRequest;
class StoreOrderRequest extends FormRequest {
    public function authorize(){ return true; }
    public function rules(){ return [
        'status'=>'nullable|in:pending,confirmed,cancelled',
        'meta'=>'nullable|array',
        'items'=>'required|array|min:1',
        'items.*.product_name'=>'required|string',
        'items.*.quantity'=>'required|integer|min:1',
        'items.*.price'=>'required|numeric|min:0',
    ]; }
}
