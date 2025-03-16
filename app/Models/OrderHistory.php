<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use HasFactory;
    protected $table = 'orderHistory';
    protected $primaryKey = 'order_history_id';
    protected $fillable = [
      'order_id',
      'created_at',
    ];
}
