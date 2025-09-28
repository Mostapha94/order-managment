<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model {
    protected $fillable = ['order_id','product_name','quantity','price','line_total'];
    protected $casts = ['price'=>'decimal:2','line_total'=>'decimal:2'];
    public function order(){ return $this->belongsTo(Order::class); }
}
