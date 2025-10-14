<?php

namespace Solutions\Core\Support;

class PermissionsCollector
{
    protected static array $permissions = [];

    public static function add(array $permissions): void
    {
        self::$permissions = array_merge(self::$permissions, $permissions);
    }

    public static function all(): array
    {
        return self::$permissions;
    }
}
