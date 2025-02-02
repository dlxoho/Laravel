<?php

namespace App\Service;

use App\Models\Notice;
use App\Models\NoticeFile;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NoticeService
{
  public final function storeNoticeWithFiles(array $data)
  {
    DB::beginTransaction();
    try {
      $notice = $this->storeNotice($data);
      $this->storeNoticeFiles($notice->notice_id, $data);
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
    if (isset($data['files']) && isset($data['originFiles'])) {
      foreach ($data['files'] as $idx => $file) {
        $originFile = $data['originFiles'][$idx];
        NoticeFile::create([
          'notice_id' => $notice_id,
          'file_name' => $file,
          'origin_file_name' => $originFile,
          'created_at' => now()
        ]);
      }
    }
  }

  private function storeNotice(array $data)
  {
    return Notice::create([
      'title' => $data['title'],
      'content' => $data['content'],
      'user_id' => Auth::user()->id ?? 'taeho',
      'created_at' => now()
    ]);
  }

  public final function getNotices(array $data)
  {
    $rows = Notice::from('notice as n')
      ->join('user as u', 'u.user_id', 'n.user_id')
      ->select('n.*,u.name,u.userID');

    if ($data && isset($data['title'])) {
      $rows = $rows->where('n.title', 'like', '%' . $data['title'] . '%');
    }
    if ($data && isset($data['content'])) {
      $rows = $rows->where('n.content', 'like', '%' . $data['content'] . '%');
    }
    if ($data && isset($data['userID'])) {
      $rows = $rows->where('n.userID', 'like', '%' . $data['userID'] . '%');
    }
    if ($data && isset($data['orderby'])) {
      $orderby = explode('|', $data['orderby']);
      $rows = $rows->orderBy($orderby[0], $orderby[1]);
    } else {
      $rows = $rows->orderBy('n.created_at', 'desc');
    }

    $rows->paginate(15);
    return $rows;
  }

  public final function modifyNotice(Notice $notice, array $data)
  {
    DB::beginTransaction();
    try {
      $notice->update([
        'title' => $data['title'],
        'content' => $data['content'],
        'updated_at' => now()
      ]);
      $this->deleteNoticeFiles($notice->notice_id);
      DB::commit();
      return [
        'resultMessage' => 'SUCCESS',
        'resultCode' => 200
      ];
    } catch (\Exception $e) {
      DB::rollBack();
      return [
        'resultMessage' => $e->getMessage(),
        'resultCode' => 500
      ];
    }
  }

  public final function delete(Notice $notice)
  {
    DB::beginTransaction();
    try {
      $this->deleteNotice($notice);
      $this->deleteNoticeFiles($notice->notice_id);
      DB::commit();
      return [
        'resultMessage' => 'SUCCESS',
        'resultCode' => 200
      ];
    } catch (\Exception $e) {
      DB::rollBack();
      return [
        'resultMessage' => $e->getMessage(),
        'resultCode' => 500
      ];
    }
  }

  private function deleteNotice(Notice $notice)
  {
    $notice->delete();
  }

  private function deleteNoticeFiles($notice_id)
  {
    NoticeFile::where('notice_id', $notice_id)->delete();
  }

  public final function show(Notice $notice)
  {
    try {
      $noticeFiles = Notice::with('noticeFiles')->find($notice);
      return [
        'resultMessage' => 'SUCCESS',
        'data' => [
          'files' => $noticeFiles,
          'notice' => $notice
        ],
        'resultCode' => 200
      ];
    } catch (ModelNotFoundException $e) {
      return [
        'resultMessage' => $e->getMessage(),
        'resultCode' => 404
      ];
    }
  }

  public final function addHit(Notice $notice)
  {
    try {
      $notice->increment('hits');
      return [
        'resultMessage' => 'SUCCESS',
        'resultCode' => 200
      ];
    } catch (\Exception $e) {
      return [
        'resultMessage' => $e->getMessage(),
        'resultCode' => 500
      ];
    }
  }
}
