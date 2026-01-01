<?php

namespace App\Service;

use App\Models\Product;
use App\Repository\ProductFileRepository;
use App\Repository\ProductRepository;
use Illuminate\Support\Facades\DB;

class ProductService
{
  private ProductRepository $productRepository;
  private ProductFileRepository $productFileRepository;

  public function __construct(ProductRepository $productRepository, ProductFileRepository $productFileRepository) {
    $this->productRepository = $productRepository;
    $this->productFileRepository = $productFileRepository;
  }

  public function getProducts(array $data) {
    return $this->productRepository->list($data);
  }

  public function show(Product $product) {
    try {
      $productFiles = $this->productRepository->show($product->product_id);
      return [
        'resultMessage' => 'SUCCESS',
        'data' => [
          'files' => $productFiles,
          'product' => $product
        ],
        'resultCode' => 200
      ];
    } catch (\Exception $e) {
      return [
        'resultMessage' => $e->getMessage(),
        'resultCode' => 500,
      ];
    }
  }

  public function addHit(Product $product) {
    try {
      $this->productRepository->addHit($product->product_id);
      return [
        'resultMessage' => 'SUCCESS',
        'resultCode' => 200
      ];
    }catch (\Exception $exception){
      return [
        'resultMessage' => $exception->getMessage(),
        'resultCode' => 500
      ];
    }
  }

  public function modifyProduct(Product $product, array $data) {
    DB::beginTransaction();
    try {
      $product->update([
        'product_name' => $data['product_name'],
        'price' => $data['product_price'],
        'product_status' => $data['product_status'],
        'product_category' => $data['product_category'],
        'purchase_price' => $data['purchase_price']
      ]);
      $this->productFileRepository($product->product_id);
      DB::commit();
      return [
        'resultMessage' => 'SUCCESS',
        'resultCode' => 200
      ];
    } catch (\Exception $exception) {
      DB::rollBack();
      return [
        'resultMessage' => $exception->getMessage(),
        'resultCode' => 500,
      ];
    }
  }

  public function deleteProduct(Product $product) {
    DB::beginTransaction();
    try {
      $this->productRepository->delete($product->product_id);
      $this->productFileRepository->deleteFile($product->product_id);
      DB::commit();
      return [
        'resultMessage' => 'SUCCESS',
        'resultCode' => 200
      ];
    } catch (\Exception $exception) {
      DB::rollBack();
      return [
        'resultMessage' => $exception->getMessage(),
        'resultCode' => 500,
      ];
    }
  }

  public function storeWithFiles(Product $product, array $data) {
    DB::beginTransaction();
    try {
      $product_data = [
        'product_name' => $data['product_name'],
        'product_status' => $data['product_status'],
        'price' => $data['price'],
        'purchase_price' => $data['purchase_price'],
        'created_at' => now(),
      ];
      $this->productRepository->create($product_data);

      if (!empty($data['files']) && !empty($data['originFiles'])) {
        $this->productFileRepository->storeFile($data['files'],$data['originFiles'],$product->product_id);
      }

      DB::commit();
      return [
        'resultMessage' => 'SUCCESS',
        'resultCode' => 201
      ];
    }catch (\Exception $exception){
      DB::rollBack();
      return [
        'resultMessage' => $exception->getMessage(),
        'resultCode' => 500,
      ];
    }
  }
}
