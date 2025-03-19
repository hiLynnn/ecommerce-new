<?php

namespace App\Providers;

use App\Models\DanhMuc;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer('*', function ($view) {
            $view->with('categories', DanhMuc::all());
        });
    }
} 