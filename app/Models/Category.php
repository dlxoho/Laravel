<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  use HasFactory;
  protected $table = 'category';
  protected $primaryKey = 'category_id';
  public $timestamps = false;
  protected $fillable = [
    'category_id',
    'category_name',
    'category_status',
    'created_at',
    'saved_file',
    'origin_file'
  ];
}
