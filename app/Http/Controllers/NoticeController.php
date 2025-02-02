<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoticeRequest;
use App\Models\Notice;
use App\Models\NoticeFile;
use App\Service\NoticeService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NoticeController extends Controller
{
  protected NoticeService $noticeService;

  public function __construct(NoticeService $noticeService)
  {
    $this->noticeService = $noticeService;
  }

  public function getList(Request $request)
  {
    $rows = $this->noticeService->getNotices($request->all());
    return response()->json([
      'data' => $rows
    ]);
  }

  public function store(NoticeRequest $request)
  {
    $result = $this->noticeService->storeNoticeWithFiles($request->all());
    return response()->json($result, $result['resultCode']);
  }

  public function update(Notice $notice, NoticeRequest $request)
  {
    $result = $this->noticeService->modifyNotice($notice, $request->all());
    return response()->json($result, $result['resultCode']);
  }

  public function delete(Notice $notice)
  {
    $result = $this->noticeService->delete($notice);
    return response()->json($result, $result['resultCode']);
  }

  public function detail(Notice $notice)
  {
    $result = $this->noticeService->show($notice);
    return response()->json($result,$result['resultCode']);
  }

  public function addHit(Notice $notice)
  {
    $result = $this->noticeService->addHit($notice);
    return response()->json($result,$result['resultCode']);
  }

}
