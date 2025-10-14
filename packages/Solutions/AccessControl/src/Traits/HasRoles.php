<?php

namespace Solutions\AccessControl\Traits;

use Solutions\AccessControl\Models\Role;

trait HasRoles
{
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function canKey(string $key): bool
    {
        // لو هو اليوزر الأساسي (id = 1) يخش على أي حاجة
        if ($this->id === 1) {
            return true;
        }

        // لو المفتاح له علاقة بالـ users أو roles امنع غير اليوزر id=1 يدخل
        if (in_array($key, [
            'users.view', 'users.create', 'users.edit', 'users.delete',
            'roles.view', 'roles.create', 'roles.edit', 'roles.delete'
        ])) {
            return false;
        }

        // باقي البيرميشنات تشتغل عادي حسب الرولز
        $roles = $this->roles()->with('permissions')->get();
        foreach ($roles as $role) {
            if ($role->permissions->where('key', $key)->count() > 0) {
                return true;
            }
        }

        return false;
    }
}
