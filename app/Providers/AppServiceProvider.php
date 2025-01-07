<?php

namespace App\Providers;

use App\DBRepository\Concretes\Product\ProductRepository;
use App\DBRepository\Concretes\Product\ProductDto;
use App\Http\Controllers\Admin\ProductController;
use App\DBRepository\Contracts\CRUDInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(ProductDto::class, ProductDto::class);

        $this->app->when(ProductController::class)->needs(CRUDInterface::class)->give(ProductRepository::class);
    }
}
