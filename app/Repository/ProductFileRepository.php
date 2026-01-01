<?php

namespace App\Repository;

interface ProductFileRepository
{
  public function deleteFile(int $product_id);
  public function storeFile(array $files, array $originFiles, int $product_id);
}
