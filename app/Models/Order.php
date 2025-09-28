<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model {
    protected $fillable = ['user_id','total','status','meta'];
    protected $casts = ['meta' => 'array', 'total' => 'decimal:2'];
    public function items(): HasMany { return $this->hasMany(OrderItem::class); }
    public function payments(): HasMany { return $this->hasMany(Payment::class); }
    public function user(){ return $this->belongsTo(User::class); }
}
