<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class VideoController extends Controller
{
    /**
     * رجّع IDs للتصنيفات اللي اسمها يحتوي أي كلمة من $keywords
     */
    private function categoryIdsByNameLike(array $keywords): array
    {
        $cacheKey = 'vc_ids_' . md5(implode('|', $keywords));

        return Cache::remember($cacheKey, 600, function () use ($keywords) {
            $cats = DB::table('video_categories')
                ->where('status', true)
                ->get(['id', 'name']);

            $ids = [];
            foreach ($cats as $c) {
                $arr = is_string($c->name) ? json_decode($c->name, true) : (array) $c->name;
                $haystack = mb_strtolower(implode(' ', array_values($arr ?? [])));

                foreach ($keywords as $kw) {
                    if (mb_strpos($haystack, mb_strtolower($kw)) !== false) {
                        $ids[] = $c->id;
                        break;
                    }
                }
            }

            return array_values(array_unique($ids));
        });
    }

    /** صفحة الريلز */
    public function reels(Request $request)
    {
        $reelIds = $this->categoryIdsByNameLike(['reel', 'reels', 'short', 'shorts', 'ريل', 'ريلز']);

        $reels = DB::table('videos')
            ->where('status', true)
            ->when(!empty($reelIds), fn($q) => $q->whereIn('category_id', $reelIds))
            ->orderBy('order')
            ->orderByDesc('id')
            ->paginate(12)
            ->through(function ($item) {
                $item->title = is_string($item->title) ? json_decode($item->title, true) : (array)$item->title;
                $item->description = is_string($item->description) ? json_decode($item->description, true) : (array)$item->description;
                return $item;
            });

        return view('front.reels.index', compact('reels'));
    }

    /** صفحة الفيديوهات الطويلة */
    public function videos(Request $request)
    {
        $videoIds = $this->categoryIdsByNameLike(['video', 'videos', 'فيديو', 'فيديوهات']);

        $videos = DB::table('videos')
            ->where('status', true)
            ->when(!empty($videoIds), fn($q) => $q->whereIn('category_id', $videoIds))
            ->orderBy('order')
            ->orderByDesc('id')
            ->paginate(12)
            ->through(function ($item) {
                $item->title = is_string($item->title) ? json_decode($item->title, true) : (array)$item->title;
                $item->description = is_string($item->description) ? json_decode($item->description, true) : (array)$item->description;
                return $item;
            });

        return view('front.video.index', compact('videos'));
    }

    /** تفاصيل فيديو طويل واحد */
    public function videoDetails($id, Request $request)
    {
        $video = DB::table('videos')->where('id', $id)->first();
        abort_if(!$video, 404);

        $video->title = is_string($video->title) ? json_decode($video->title, true) : (array)$video->title;
        $video->description = is_string($video->description) ? json_decode($video->description, true) : (array)$video->description;

        $videoIds = $this->categoryIdsByNameLike(['video', 'videos', 'فيديو', 'فيديوهات']);

        $relatedvideos = DB::table('videos')
            ->where('status', true)
            ->when(!empty($videoIds), fn($q) => $q->whereIn('category_id', $videoIds))
            ->where('id', '<>', $id)
            ->orderBy('order')
            ->orderByDesc('id')
            ->take(6)
            ->get()
            ->map(function ($item) {
                $item->title = is_string($item->title) ? json_decode($item->title, true) : (array)$item->title;
                $item->description = is_string($item->description) ? json_decode($item->description, true) : (array)$item->description;
                return $item;
            });

        return view('front.video.details', compact('video', 'relatedvideos'));
    }
}
