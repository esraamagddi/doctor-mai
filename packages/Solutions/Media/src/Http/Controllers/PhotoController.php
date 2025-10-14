<?php

namespace Solutions\Media\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Solutions\Media\Models\Photo;

class PhotoController extends Controller
{
    private function resolveLocales(Request $request): array
    {
        try {
            $langs = \Solutions\Language\Models\Language::query()
                ->where('status', 1)->orderBy('order')
                ->get(['code','name','dir','is_default']);
        } catch (\Throwable $e) {
            $langs = collect();
        }
        if ($langs->isEmpty()) {
            $langs = collect([
                (object)['code'=>'en','name'=>'English','dir'=>'ltr','is_default'=>app()->getLocale()==='en'],
            ]);
        }
        $active = (string) $request->get('lang', '');
        if (!$active) {
            $active = optional($langs->firstWhere('is_default', 1))->code ?: app()->getLocale();
        }
        if (!$langs->contains('code', $active)) {
            $active = optional($langs->first())->code ?: 'en';
        }
        return [$langs, $active];
    }

    public function index(Request $request)
    {
        $perPage = (int)($request->get('per_page', 12));
        $items = Photo::orderBy('order')->orderByDesc('id')->paginate($perPage);
        return view('media::photos.index', compact('items'));
    }

    public function create(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        return view('media::photos.create', compact('langs', 'activeLocale'));
    }

    public function store(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        $default = optional($langs->firstWhere('is_default', 1))->code ?: app()->getLocale() ?: 'en';

        $rules = [
            'title'           => 'required|array',
            'title.'.$default => 'required|string',
            'title.*'         => 'nullable|string',
            'description'     => 'nullable|array',
            'description.*'   => 'nullable|string',
            'image'           => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:8192',
            'order'           => 'nullable|integer|min:0',
            'status'          => 'nullable|boolean',
        ];

        $data = $request->validate($rules);
        $data['image']  = $request->file('image')->store('media/photos', 'public');
        $data['status'] = array_key_exists('status', $data) ? (int) !!$data['status'] : 1;
        $data['order']  = $data['order'] ?? (int) (Photo::max('order') + 1);

        Photo::create($data);

        return redirect()->route('media.photos.index')->with('ok', 'Created');
    }

    public function edit(Request $request, Photo $photo)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        if (old()) {
            foreach (array_keys((array) old('title', [])) as $k) {
                if ($k && $langs->contains('code', $k)) { $activeLocale = $k; break; }
            }
        }



        return view('media::photos.edit', compact('photo', 'langs', 'activeLocale'));
    }

    public function update(Request $request, Photo $photo)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        $default = optional($langs->firstWhere('is_default', 1))->code ?: app()->getLocale() ?: 'en';

        $rules = [
            'title'           => 'required|array',
            'title.'.$default => 'required|string',
            'title.*'         => 'nullable|string',
            'description'     => 'nullable|array',
            'description.*'   => 'nullable|string',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:8192',
            'order'           => 'nullable|integer|min:0',
            'status'          => 'nullable|boolean',
        ];

        $data = $request->validate($rules);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('media/photos', 'public');
        } else {
            unset($data['image']);
        }

        $data['status'] = array_key_exists('status', $data) ? (int) !!$data['status'] : $photo->status;

        $photo->update($data);

        return redirect()->route('media.photos.index')->with('ok', 'Updated');
    }

    public function destroy(Photo $photo)
    {
        $photo->delete();
        return redirect()->route('media.photos.index')->with('ok', 'Deleted');
    }

    public function toggleStatus(Photo $photo)
    {
        $photo->status = $photo->status ? 0 : 1;
        $photo->save();

        if (request()->wantsJson()) {
            return response()->json(['status' => $photo->status]);
        }

        return back()->with('ok', 'Toggled');
    }

    public function updateOrder(Request $request)
    {
        $payload = $request->input('rows', $request->input('orders', $request->input('order', [])));

        if (!is_array($payload) || empty($payload)) {
            return response()->json(['ok' => false, 'message' => 'No payload'], 422);
        }

        $isList = array_keys($payload) === range(0, count($payload) - 1);
        $rows = [];

        if ($isList) {
            foreach ($payload as $row) {
                if (!isset($row['id'])) continue;
                $rows[(int)$row['id']] = (int)($row['order'] ?? 0);
            }
        } else {
            foreach ($payload as $id => $order) {
                $rows[(int)$id] = (int)$order;
            }
        }

        if (!$rows) {
            return response()->json(['ok' => false, 'message' => 'No valid rows'], 422);
        }

        foreach ($rows as $id => $ord) {
            Photo::whereKey($id)->update(['order' => $ord]);
        }

        return response()->json(['ok' => true]);
    }
}
