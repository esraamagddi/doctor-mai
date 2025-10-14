<?php

namespace Solutions\Core\Support;

use Illuminate\Support\Facades\Route;

class SidebarCollector
{
    protected static array $paths = [];

    public static function add(string $filePath): void
    {
        self::$paths[] = $filePath;
    }

    public static function raw(): array
    {
        $all = [];
        foreach (self::$paths as $path) {
            if (file_exists($path)) {
                $items = include $path;
                if (is_array($items)) {
                    $all = array_merge($all, $items);
                }
            }
        }
        return $all;
    }

    /**
     * يرجّع العناصر بعد الفلترة والترتيب (بدون تجميع جروبات)
     */
    public static function get(): array
    {
        $items = self::raw();

        $user = auth()->user();

        // فلترة حسب can و Route::has
        $filter = function ($item) use ($user) {
            
            if (!empty($item['can']) && (!$user || !$user->can($item['can']))) {
                return false;
            }
            if (!empty($item['route']) && !Route::has($item['route'])) {

                return false;
            }
            return true;
        };

        $items = array_values(array_filter($items, $filter));

        // ترتيب الأطفال + فلترتهم
        foreach ($items as &$item) {
            if (!empty($item['children']) && is_array($item['children'])) {
                $item['children'] = array_values(array_filter($item['children'], $filter));
                usort($item['children'], fn($a, $b) => ($a['order'] ?? 9999) <=> ($b['order'] ?? 9999));
            }
        }

        // ترتيب العناصر الرئيسية
        usort($items, fn($a, $b) => ($a['order'] ?? 9999) <=> ($b['order'] ?? 9999));

        return $items;
    }

    /**
     * يرجّع المنيو مجمّعة حسب الجروبات مع ترتيب الجروبات والعناصر
     */
    public static function getByGroups(): array
    {
        $items = self::get();

        $groupsConfig = config('sidebar.groups', []);
        $defaultGroup = config('sidebar.default_group', 'core');

        // تجميع حسب الجروب
        $grouped = [];
        foreach ($items as $item) {
            $groupKey = $item['group'] ?? $defaultGroup;
            $grouped[$groupKey][] = $item;
        }

        // ترتيب الجروبات حسب config
        $sortedGroups = collect($grouped)
            ->mapWithKeys(function ($items, $key) use ($groupsConfig) {
                $label = $groupsConfig[$key]['label'] ?? $key;
                $order = $groupsConfig[$key]['order'] ?? 9999;
                return [$key => ['label' => $label, 'order' => $order, 'items' => $items]];
            })
            ->sortBy('order')
            ->values()
            ->all();

        return $sortedGroups;  // كل عنصر: ['label'=>..., 'order'=>..., 'items'=>[...]]
    }
}
