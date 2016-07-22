<?php

namespace ErrorStream\ErrorStream\Facades;

use Illuminate\Support\Facades\Facade;

class ErrorStream extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'errorstream';
    }
}
