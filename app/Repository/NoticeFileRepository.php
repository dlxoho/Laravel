<?php

namespace App\Repository;

use App\Models\Notice;

interface NoticeFileRepository
{
  public function deleteFiles(int $notice_id);
  public function storeFile(array $files,array $originFiles, int $notice_id);
}
