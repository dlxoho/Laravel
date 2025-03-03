<?php

namespace App\Repository;

use App\Models\Notice;
use App\Models\NoticeFile;
use App\Repository\NoticeFileRepository;

class NoticeFileRepositoryImpl implements NoticeFileRepository
{
  public function deleteFiles(int $notice_id)
  {
    return NoticeFile::where('notice_id', $notice_id)->delete();
  }

  public function storeFile(array $files, array $originFiles, int $notice_id)
  {
    foreach ($files as $idx => $file) {
      NoticeFile::create([
        'notice_id' => $notice_id,
        'file_name' => $file,
        'origin_file_name' => $originFiles[$idx],
        'created_at' => now()
      ]);
    }
  }
}
