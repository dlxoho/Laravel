<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $data)
 */
class Notice extends Model
{
  use HasFactory;
  protected $table = "notice";
  protected $fillable = [
    'notice_id',
    'title',
    'contents',
    'category',
    'status',
    'admin_id',
    'created_at',
    'updated_at',
    'hits'
  ];
  protected $primaryKey = "notice_id";
  public $timestamps = false;

  public function noticeFiles(): \Illuminate\Database\Eloquent\Relations\HasMany
  {
    return $this->hasMany(NoticeFile::class, 'notice_id');
  }
}
