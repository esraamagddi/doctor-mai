<?php

namespace Solutions\AccessControl\Http\Controllers;

use App\Http\Controllers\Controller;
use Solutions\AccessControl\Models\Permission;

class PermissionController extends Controller
{
    // Scan packages/Solutions/**/(src/)?Resources/permissions.php and sync to DB
    public function sync()
    {
        $base = base_path('packages/Solutions');
        if (!is_dir($base)) {
            return back()->with('error', 'Solutions directory not found');
        }

        // ابحث في المسارين
        $patterns = [
            $base . '/*/Resources/permissions.php',
            $base . '/*/src/Resources/permissions.php',
        ];

        $paths = [];
        foreach ($patterns as $p) {
            $paths = array_merge($paths, glob($p) ?: []);
        }

        $added = 0;

        foreach ($paths as $path) {
            $normalized = str_replace('\\', '/', $path);
            if (!preg_match('#/packages/Solutions/([^/]+)/#', $normalized, $m)) {
                continue;
            }
            $module = $m[1];
            $moduleKey = strtolower($module);

            $list = include $path;
            if (!is_array($list)) {
                continue;
            }
            foreach ($list as $perm) {
                if (!is_array($perm) || empty($perm['key'])) {
                    continue;
                }

                $key = $moduleKey . '.' . $perm['key'];

                $model = Permission::firstOrCreate(
                    ['key' => $key],
                    ['module' => $module, 'label' => $perm['label'] ?? $key]
                );

                if ($model->wasRecentlyCreated) {
                    $added++;
                }
            }
        }

        return back()->with('success', __('acl::messages.synced', ['n' => $added]));
    }
    public function delete($id)
    {
      $model = Permission::where('module',$id)->delete();

        
        return back()->with('success', __('acl::messages.deleted'));
    }
}
