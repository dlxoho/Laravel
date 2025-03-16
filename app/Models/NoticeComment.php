<?php

namespace App\Models;

use App\Traits\TimestampTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeComment extends Model
{
    use HasFactory, TimestampTrait;

    protected $table = 'noticeComment';
    protected $primaryKey = 'notice_comment_id';
    public $timestamps = false;
    protected $fillable = [
      'notice_comment_id',
      'notice_id',
      'user_id',
      'comment',
    ];
}
