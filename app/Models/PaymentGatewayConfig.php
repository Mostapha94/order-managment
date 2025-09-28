<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PaymentGatewayConfig extends Model {
    protected $fillable = ['gateway_key','config'];
    protected $casts = ['config'=>'array'];
}
