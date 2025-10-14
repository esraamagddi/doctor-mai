<?php

namespace Solutions\Core\Facades;

use Illuminate\Support\Facades\Facade;

class PermissionsCollector extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'core.permissions.collector';
    }
}
