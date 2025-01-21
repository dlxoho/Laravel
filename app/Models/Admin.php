<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admin';
    protected $fillable = [
      'admin_id',
      'admin_name',
      'admin_email',
      'admin_password',
      'admin_phone',
      'admin_level',
      'created_at',
    ];
    protected $primaryKey = 'admin_id';
    public $timestamps = false;
}
