<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'orderDetail';
    protected $primaryKey = "order_detail_id";
    public $timestamps = false;
    protected $fillable = [
      'order_id',
      'product_id',
    ];
}
