<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLoginHistory extends Model
{
    use HasFactory;

    protected $table = 'userLoginHistory';
    protected $primaryKey = 'user_login_history_id';
    public $incrementing = false;
    protected $fillable = [
      'user_login_history_id',
      'user_id',
      'login_ip',
      'created_at',
    ];
}
