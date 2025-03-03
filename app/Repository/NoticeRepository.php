<?php

namespace App\Repository;

use App\Models\Notice;

interface NoticeRepository
{
  public function create(array $data);
  public function update(array $data, int $notice_id);
  public function list(array $data);
  public function delete(int $notice_id);
  public function show(int $notice_id);
  public function addHit(int $notice_id);
}
