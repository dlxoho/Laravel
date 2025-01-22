<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\NoticeFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NoticeController extends Controller
{
  public function getList(Request $request)
  {
    $rows = Notice::from('notice as n')
      ->join('users as u', 'u.user_id', 'n.user_id')
      ->select('n.*,u.name,u.userID');

    if ($request->has('title')) {
      $rows->where('n.title','like','%'. $request->input('title') .'%');
    }

    if ($request->has('content')) {
      $rows->where('n.content','like','%'. $request->input('content') .'%');
    }

    if ($request->has('u.userID')) {
      $rows->where('u.userID',$request->input('u.userID'));
    }

    if ($request->has('orderby')) {
      $orderby = explode('|', $request->input('orderby'));
      $rows->orderBy($orderby[0],$orderby[1]);
    } else {
      $rows->orderBy('n.created_at', 'desc');
    }

    $rows->paginate(15);

    return response()->json([
      'data' => $rows,
      'resultCode' => 200
    ]);
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'title' => 'required|string|max:255',
      'content' => 'required',
      'originFiles' => 'nullable|array',
      'files' => 'nullable|array',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'errors' => $validator->errors()->toArray()
      ],422);
    }

    DB::beginTransaction();
    try {
      $notice = Notice::create([
        'title' => $request->input('title'),
        'content' => $request->input('content'),
        'user_id' => Auth::user()->id,
        'created_at' => now()
      ]);

      if ($request->has('originFiles') && $request->has('files')) {
        $originFiles = $request->input('originFiles');
        $files = $request->input('files');

        foreach ($files as $idx => $file) {
          NoticeFile::create([
            'notice_file_id' => $notice->id,
            'file_name' => $file,
            'origin_file_name' => $originFiles[$idx],
            'created_at' => now()
          ]);
        }
      }

      DB::commit();
      return response()->json([
        'resultMessage' => 'success'
      ],201);

    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json([
        'resultMessage' => $e->getMessage()
      ],500);
    }
  }

  public function update(Notice $notice, Request $request)
  {
    $validator = Validator::make($request->all(), [
      'title' => 'required|string|max:255',
      'content' => 'required',
      'originFiles' => 'nullable|array',
      'files' => 'nullable|array',
    ]);

    if ($validator->fails()) {
      return response()->json([
        'errors' => $validator->errors()->toArray()
      ],422);
    }

    DB::beginTransaction();
    try {
      $notice->update([
        'title' => $request->input('title'),
        'content' => $request->input('content'),
        'updated_at' => now()
      ]);

      NoticeFile::where('notice_id',$notice->notice_id)->delete();

      if ($request->has('originFiles') && $request->has('files')) {
        $originFiles = $request->input('originFiles');
        $files = $request->input('files');

        foreach ($files as $idx => $file) {
          NoticeFile::create([
            'notice_file_id' => $notice->notice_id,
            'file_name' => $file,
            'origin_file_name' => $originFiles[$idx],
            'created_at' => now()
          ]);
        }
      }

      DB::commit();
      return response()->json([
        'resultMessage' => 'success'
      ],201);

    } catch (\Exception $e) {
      DB::rollBack();
      return response()->json([
        'resultMessage' => $e->getMessage()
      ],500);
    }
  }

  public function delete(Notice $notice)
  {
    DB::beginTransaction();
    try {
      NoticeFile::where('notice_id',$notice->id)->delete();
      $notice->delete();

      $resultMessage = 'success';
      $statusCode = 200;
      DB::commit();
    } catch (\Exception $e) {
      $resultMessage = $e->getMessage();
      $statusCode = 500;
      DB::rollBack();
    }

    return response()->json([
      'resultMessage' => $resultMessage
    ],$statusCode);
  }

  public function detail(Notice $notice)
  {
    $notice = Notice::with('noticeFiles')->findOrFail($notice);
    return response()->json([
      'resultMessage' => 'success',
      'data' => [
        'notice' => $notice,
        'files' => $notice->noticeFiles
      ]
    ]);
  }
}
