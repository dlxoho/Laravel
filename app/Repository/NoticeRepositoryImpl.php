<?php

namespace App\Repository;

use App\Models\Notice;
use App\Repository\NoticeRepository;

class NoticeRepositoryImpl implements NoticeRepository
{
  public function create(array $data)
  {
    return Notice::create($data);
  }

  public function update(array $data, int $notice_id)
  {
    $notice = Notice::find($notice_id);
    return $notice->update($data);
  }

  public function list(array $data)
  {
    $rows = Notice::from('notice as n')
      ->join('admin as a', 'a.admin_id', 'n.admin_id')
      ->select('n.*, a.admin_name');

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
    return $rows->paginate(15);
  }

  public function delete(int $notice_id)
  {
    return Notice::destroy($notice_id);
  }

  public function show(int $notice_id)
  {
    // 즉시 로딩을 사용한 성능 최적화
    // 즉시로딩 (Eager Loading) : 데이터를 조회할때, 연관된 데이터까지 한번에 불러오는것
    // 지연로딩 (Lazy Loading) : 필요한 순간에 데이터를 조회하는 방식
    return Notice::with('noticeFiles')->find($notice_id);
  }

  public function addHit(int $notice_id)
  {
    $notice = Notice::find($notice_id);
    return $notice->increment('hits');
  }
}
