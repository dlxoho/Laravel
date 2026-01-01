<?php

namespace App\Repository;

use App\Models\ProductFile;

class ProductFileRepositoryImpl implements ProductFileRepository
{
  public function deleteFile(int $product_id)
  {
    return ProductFile::where('product_id', $product_id)->delete();
  }

  public function storeFile(array $files, array $originFiles, int $product_id)
  {
    foreach ($files as $idx => $file) {
      ProductFile::create([
        'product_id' => $product_id,
        'file_name' => $file,
        'origin_file' => $originFiles[$idx],
        'created_at' => now()
      ]);
    }
  }
}
