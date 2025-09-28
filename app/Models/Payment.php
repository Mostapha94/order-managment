<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model {
    protected $fillable = ['payment_id','order_id','status','method','payload'];
    protected $casts = ['payload'=>'array'];
    public function order(){ return $this->belongsTo(Order::class); }
}
