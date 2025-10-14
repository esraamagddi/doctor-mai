<?php

namespace Solutions\Core\Facades;

use Illuminate\Support\Facades\Facade;

class SidebarCollector extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'sidebar-collector';
    }
}
