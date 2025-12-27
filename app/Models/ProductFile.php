<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFile extends Model
{
  use HasFactory;
  protected $primaryKey = 'product_file_id';
  protected $table = 'product_file';
  protected $fillable = [
    'product_id',
    'product_file_id',
    'file_path',
    'saved_file',
    'origin_file'
  ];
  public $timestamps = false;

}
