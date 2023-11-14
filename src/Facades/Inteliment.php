<?php

namespace ChrisReedIO\Inteliment\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ChrisReedIO\Inteliment\Inteliment
 */
class Inteliment extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \ChrisReedIO\Inteliment\Inteliment::class;
    }
}
