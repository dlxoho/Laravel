<?php

namespace App\Models;

use App\Traits\TimestampTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  use HasFactory, TimestampTrait;
  protected $table = "product";
  protected $primaryKey = "product_id";
  public $timestamps = false;
  protected $fillable = array(
    'product_id',
    'product_name',
    'product_status',
    'price',
    'purchase_price',
    'hits',
    'created_at',
  );
}
