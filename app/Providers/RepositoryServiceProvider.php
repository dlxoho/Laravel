<?php

namespace App\Providers;

use App\Repository\NoticeFileRepository;
use App\Repository\NoticeFileRepositoryImpl;
use App\Repository\NoticeRepository;
use App\Repository\NoticeRepositoryImpl;
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
