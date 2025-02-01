<?php

namespace App\Service;

use App\Models\Notice;
use App\Models\NoticeFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NoticeService
{
  public final function storeNoticeWithFiles($data)
  {
    DB::beginTransaction();
    try {
      $notice = $this->storeNotice($data);
      $this->storeNoticeFiles($notice, $data);
      DB::commit();
      return [
        'resultMessage' => 'SUCCESS',
        'resultCode' => 201
      ];
    } catch (\Exception $e) {
      DB::rollBack();
      return [
        'resultMessage' => $e->getMessage(),
        'resultCode' => 500
      ];
    }
  }

  private function storeNoticeFiles($notice_id, array $data)
  {
    foreach ($data['files'] as $idx => $file) {
      $originFile = $data['originFiles'][$idx];
      NoticeFile::create([
        'notice_file_id' => $notice_id,
        'file_name' => $file,
        'origin_file_name' => $originFile,
        'created_at' => now()
      ]);
    }
  }

  private function storeNotice(array $data)
  {
    return Notice::create([
      'title' => $data['title'],
      'content' => $data['content'],
      'user_id' => Auth::user()->id,
      'created_at' => now()
    ]);
  }

  public final function getNotices()
  {

  }

  public final function modifyNotice()
  {

  }

  public final function delete()
  {

  }

  public final function show()
  {

  }
}
