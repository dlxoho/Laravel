<?php

namespace App\Models;

use App\Traits\TimestampTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "order";
    protected $primaryKey = "order_id";
    public $timestamps = false;
    protected $fillable = [
      'order_id',
      'user_id',
      'order_status',
      'total_price',
      'created_at',
    ];

    public function orderDetails(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
      return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
