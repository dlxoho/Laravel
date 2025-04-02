<?php

namespace App\Repository;

use App\Models\Notice;
use App\Models\Product;

class ProductRepositoryImpl implements ProductRepository
{
  public function create(array $data)
  {
    return Product::create($data);
  }

  public function update(array $data, int $product_id)
  {
    $product = Product::find($product_id);
    return $product->update($data);
  }

  public function delete(int $product_id)
  {
    return Product::destroy($product_id);
  }

  public function show(int $product_id)
  {
    return Product::find($product_id);
  }

  public function addHit(int $product_id)
  {
    $product = Product::find($product_id);
    return $product->increment('hit');
  }

  public function list(array $data)
  {
    $rows = Product::from('product as p');

    if ($data && isset($data['product_name'])) {
      $rows = $rows->where('product_name','like','%'.$data['product_name'].'%');
    }
    if ($data && isset($data['product_status'])) {
      $rows = $rows->where('product_status',$data['product_status']);
    }

    return $rows->orderBy('created_at','desc')->paginate(10);
  }
}
