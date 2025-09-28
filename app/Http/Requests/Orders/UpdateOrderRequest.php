<?php
namespace App\Http\Requests\Orders;
use Illuminate\Foundation\Http\FormRequest;
class UpdateOrderRequest extends FormRequest {
    public function authorize(){ return true; }
    public function rules(){ return [
        'status'=>'nullable|in:pending,confirmed,cancelled',
        'meta'=>'nullable|array',
        'items'=>'nullable|array|min:1',
        'items.*.product_name'=>'required_with:items|string',
        'items.*.quantity'=>'required_with:items|integer|min:1',
        'items.*.price'=>'required_with:items|numeric|min:0',
    ]; }
}
