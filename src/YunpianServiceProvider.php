<?php
namespace KVZ\Laravel\Yunpian;

use Illuminate\Support\ServiceProvider;

class YunpianServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('yunpian', function ($app) {
            return new YunpianService();
        });
    }
}