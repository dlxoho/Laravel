<?php

namespace App\Providers;

use App\Repository\NoticeFileRepository;
use App\Repository\NoticeFileRepositoryImpl;
use App\Repository\NoticeRepository;
use App\Repository\NoticeRepositoryImpl;
use App\Repository\ProductRepository;
use App\Repository\ProductRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind(NoticeRepository::class, NoticeRepositoryImpl::class);
      $this->app->bind(NoticeFileRepository::class, NoticeFileRepositoryImpl::class);
      $this->app->bind(ProductRepository::class, ProductRepositoryImpl::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
