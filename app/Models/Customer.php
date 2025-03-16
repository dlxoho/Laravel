<?php

namespace App\Models;

use App\Traits\TimestampTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, TimestampTrait;

    protected $table = "customer";
    protected $primaryKey = "customer_id";
    public $timestamps = false;
    protected $fillable = [
      'customer_id',
      'customer_name',
      'business_registration_no',
      'customer_address',
      'charger',
      'charger_phone',
    ];

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
      return $this->hasMany(Product::class, 'customer_id', 'customer_id');
    }
}
