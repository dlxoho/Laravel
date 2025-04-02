<?php

namespace App\Repository;

interface ProductRepository
{
  public function create(array $data);
  public function update(array $data, int $product_id);
  public function delete(int $product_id);
  public function show(int $product_id);
  public function addHit(int $product_id);
  public function list(array $data);
}
