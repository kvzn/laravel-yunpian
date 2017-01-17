<?php
namespace KVZ\Laravel\Yunpian;

use Illuminate\Support\Facades\Facade;

class YunpianFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'yunpian';
    }
}