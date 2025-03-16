<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\TimestampTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,TimestampTrait;
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
      'id',
      'name',
      'email',
      'password',
      'phone',
      'address',
      'address2',
      'grade',
    ];

    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
      return $this->hasMany(Order::class, 'order_id');
    }

    public function notices(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
      return $this->hasMany(Notice::class, 'notice_id');
    }
}
