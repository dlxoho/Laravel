<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class NoticeFile extends Model
{
  use HasFactory;
  protected $table = 'notice_files';
  protected $primaryKey = 'notice_file_id';
  protected $fillable = [
    'notice_id',
    'notice_file_id',
    'saved_file',
    'origin_file',
    'file_path',
    'created_at'
  ];
  public $timestamps = false;

  public function notice(): \Illuminate\Database\Eloquent\Relations\BelongsTo
  {
    return $this->belongsTo(Notice::class, 'notice_id');
  }
}
