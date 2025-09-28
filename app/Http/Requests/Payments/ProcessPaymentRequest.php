<?php
namespace App\Http\Requests\Payments;
use Illuminate\Foundation\Http\FormRequest;
class ProcessPaymentRequest extends FormRequest {
    public function authorize(){ return true; }
    public function rules(){ return [
        'method'=>'required|string',
        'payload'=>'nullable|array'
    ]; }
}
