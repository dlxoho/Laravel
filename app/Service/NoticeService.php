<?php

namespace App\Service;

use App\Models\Notice;
use App\Models\NoticeFile;
use App\Repository\NoticeFileRepository;
use App\Repository\NoticeRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NoticeService
{
  // 구현체가 아닌 Repository 인터페이스를 의존하는 이유
  // SOLID 원칙 중 DIP(의존성 역전 원칙) - 상위모듈은 하위모듈에 의존하지말고 인터페이스에 의존해야한다.
  // 특정 구현체에 의존하는게 아닌 인터페이스를 의존하게되면, 구현제를 쉽게 갈아 끼울수있음 (수정에 쉽게 대처가 가능하다)
  private NoticeRepository $noticeRepository;
  private NoticeFileRepository $noticeFileRepository;

  public function __construct(NoticeRepository $noticeRepository, NoticeFileRepository $noticeFileRepository)
  {
    $this->noticeRepository = $noticeRepository;
    $this->noticeFileRepository = $noticeFileRepository;
  }

  public function storeNoticeWithFiles(array $data)
  {
    return DB::transaction(function () use ($data) {
      $notice_data = [
        'title' => $data['title'],
        'contents' => $data['content'],
        'user_id' => Auth::id(),
        'created_at' => now(),
      ];
      $notice = $this->noticeRepository->create($notice_data);

      if (!empty($data['files']) && !empty($data['originFiles'])) {
        $this->noticeFileRepository->storeFile($data['files'], $data['originFiles'], $notice->notice_id);
      }
    });
  }

  public function getNotices(array $data)
  {
    return $this->noticeRepository->list($data);
  }

  public function modifyNotice(Notice $notice, array $data)
  {
    return DB::transaction(function () use ($notice, $data) {
      $dataArr = [
        'title' => $data['title'],
        'contents' => $data['content'],
        'updated_at' => now()
      ];
      $this->noticeRepository->update($dataArr, $notice->notice_id);
      $this->noticeFileRepository->deleteFiles($notice->notice_id);
    });
  }

  public function delete(Notice $notice)
  {
    return DB::transaction(function () use ($notice) {
      $this->noticeRepository->delete($notice->notice_id);
      $this->noticeFileRepository->deleteFiles($notice->notice_id);
    });
  }

  public function show(Notice $notice)
  {
    return $this->noticeRepository->show($notice->notice_id);
  }

  public function addHit(Notice $notice)
  {
    return $this->noticeRepository->addHit($notice);
  }
}
