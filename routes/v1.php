<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoticeController;

// version 1
Route::controller(NoticeController::class)->group(function () {
  // list
  Route::get('/notices','getList');
  // store
  Route::post('/notice','store');
  // delete
  Route::delete('/notice/{notice}','delete');
  // show
  Route::get('/notice/{notice}','detail');
  // modify
  Route::put('/notice/{notice}','update');
  // add hits
  Route::put('/notice/{notice}/hits','addHit');
});


Route::controller(ProductController::class)->group(function () {
  
});
