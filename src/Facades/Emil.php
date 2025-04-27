<?php

namespace Happytodev\Emil\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Happytodev\Emil\Emil
 */
class Emil extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Happytodev\Emil\Emil::class;
    }
}
