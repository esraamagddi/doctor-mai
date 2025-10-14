<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Solutions\Services\Models\Service;

class ServicesController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::where('status', true)
            ->orderBy('id', 'desc')
            ->get();

        return view('front.services.index', compact('services'));
    }

    public function details($id, Request $request)
    {
        $services = Service::findOrFail($id);

        $relatedservices = Service::where('status', true)
            ->where('id', '<>', $id)
            ->orderBy('id', 'desc')
            ->take(4)
            ->get();

        return view('front.services.details', compact('services', 'relatedservices'));
    }
}
