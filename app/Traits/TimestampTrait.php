<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

trait TimestampTrait
{
  public static function bootTimestampTrait()
  {
    static::creating(function (Model $model) {
      if (!$model->isDirty('created_at')) {
        $model->created_at = Carbon::now();
      }
      if (!$model->isDirty('updated_at')) {
        $model->updated_at = Carbon::now();
      }
    });

    static::updating(function (Model $model) {
      $model->updated_at = Carbon::now();
    });
  }

  public function initializeTimestampTrait()
  {
    $this->casts['created_at'] = 'datetime';
    $this->casts['updated_at'] = 'datetime';
  }
}
