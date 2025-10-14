<?php

namespace Solutions\Team\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Solutions\Team\Models\Team;
use Solutions\Language\Models\Language;

class TeamController extends Controller
{
    private function resolveLocales(Request $request): array
    {
        try {
            $langs = Language::query()
                ->where('status', 1)
                ->orderBy('order')
                ->get(['code','name','dir','is_default']);
        } catch (\Throwable $e) {
            $langs = collect();
        }

        if ($langs->isEmpty()) {
            $langs = collect([
                (object)['code' => 'en', 'name' => 'English', 'dir' => 'ltr', 'is_default' => app()->getLocale() === 'en'],
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
        $items = Team::orderBy('order')->paginate($perPage);
        return view('team::index', compact('items'));
    }

    public function create(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);


        return view('team::create', compact('langs', 'activeLocale'));
    }

    public function store(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        $rules = [
            'name' => 'required|array',
            'job_title' => 'nullable|array',
            'description' => 'nullable|array',
            'image' => 'nullable|image|max:5120',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',

        ];

        foreach ($langs as $L) {
            $rules['name.'.$L->code] = 'required|string';
            $rules['job_title.'.$L->code] = 'nullable|string';
            $rules['description.'.$L->code] = 'nullable|string';
        }

        $data = $request->validate($rules);
        $data['status'] = $data['status'] ?? 1;
        $data['order'] = $data['order'] ?? (int)(Team::max('order') + 1);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('team', 'public');
        }

        Team::create($data);

        return redirect()->route('team.index')->with('ok', 'Created');
    }

    public function edit(Request $request, Team $team)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        if (old()) {
            foreach (array_keys((array) old('name', [])) as $k) {
                if ($k && $langs->contains('code', $k)) { $activeLocale = $k; break; }
            }
        }


        return view('team::edit', compact('team', 'langs', 'activeLocale'));
    }

    public function update(Request $request, Team $team)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        $rules = [
            'name' => 'required|array',
            'job_title' => 'nullable|array',
            'description' => 'nullable|array',
            'image' => 'nullable|image|max:5120',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ];

        foreach ($langs as $L) {
            $rules['name.'.$L->code] = 'required|string';
            $rules['job_title.'.$L->code] = 'nullable|string';
            $rules['description.'.$L->code] = 'nullable|string';
        }

        $data = $request->validate($rules);

        if ($request->hasFile('image')) {
            if ($team->image) {
                Storage::disk('public')->delete($team->image);
            }
            $data['image'] = $request->file('image')->store('team', 'public');
        } else {
            $data['image'] = $team->image;
        }

        $team->update($data);

        return redirect()->route('team.index')->with('ok', 'Updated');
    }

    public function destroy(Team $team)
    {
        if ($team->image) {
            Storage::disk('public')->delete($team->image);
        }
        $team->delete();
        return redirect()->route('team.index')->with('ok', 'Deleted');
    }

    public function toggleStatus(Team $team)
    {
        $team->status = $team->status ? 0 : 1;
        $team->save();
        if (request()->wantsJson()) {
            return response()->json(['status' => $team->status]);
        }
        return redirect()->back()->with('ok', 'Toggled');
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
            Team::whereKey($id)->update(['order' => $ord]);
        }

        return response()->json(['ok' => true]);
    }
}
