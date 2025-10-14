<?php

namespace Solutions\Transformation\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Solutions\Core\Traits\HasLocaleResolution;
use Solutions\Transformation\Models\Transformation;

class TransformationController extends Controller
{
    use HasLocaleResolution;

    public function index(Request $request)
    {
        $items = Transformation::get();
        [$langs, $activeLocale] = $this->resolveLocales($request);
        return view('transformation::index', compact('items', 'langs', 'activeLocale'));
    }

    // Show create form
    public function create(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        return view('transformation::form', compact('langs', 'activeLocale'));
    }

    // Store new item
    public function store(Request $request)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);

        $rules = [
            'before_image' => 'required|image|max:5120',
            'after_image'  => 'required|image|max:5120',
        ];
        foreach ($langs as $L) {
            $rules['title.'.$L->code] = 'required|string';
            $rules['description.'.$L->code] = 'required|string';
        }
        $data = $request->validate($rules);

        // Images
        foreach (['before_image', 'after_image'] as $imgField) {
            if ($request->hasFile($imgField)) {
                $data[$imgField] = $request->file($imgField)->store('transformations', 'public');
            }
        }
        Transformation::create($data);
        return redirect()->route('transformations.index')->with('ok', 'Added');
    }

    // Show Edit Form
    public function edit(Request $request, Transformation $transformation)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        return view('transformation::form', compact('transformation', 'langs', 'activeLocale'));
    }

    // Update 
    public function update(Request $request, Transformation $transformation)
    {
        [$langs, $activeLocale] = $this->resolveLocales($request);
        $rules = [];
        foreach (['before_image', 'after_image'] as $imgField) {
            $rules[$imgField] = 'nullable|image|max:5120';
        }
        foreach ($langs as $L) {
            $rules['title.'.$L->code] = 'required|string';
            $rules['description.'.$L->code] = 'required|string';
        }
        $data = $request->validate($rules);

        // Images
        foreach (['before_image', 'after_image'] as $imgField) {
            if ($request->hasFile($imgField)) {
                if ($transformation->$imgField) {
                    Storage::disk('public')->delete($transformation->$imgField);
                }
                $data[$imgField] = $request->file($imgField)->store('transformations', 'public');
            } else {
                $data[$imgField] = $transformation->$imgField;
            }
        }
        $transformation->update($data);
        return redirect()->route('transformations.index')->with('ok', 'Updated');
    }

    public function destroy(Transformation $transformation)
    {
        foreach (['before_image', 'after_image'] as $imgField) {
            if ($transformation->$imgField) {
                Storage::disk('public')->delete($transformation->$imgField);
            }
        }
        $transformation->delete();
        return redirect()->route('transformations.index')->with('ok', 'Deleted');
    }
}
