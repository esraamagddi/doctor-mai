<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Solutions\Seo\Models\Seo;
class SeoController extends Controller
{
    public static function index($slug)
    {
        return Seo::where('slug', $slug)->first();
    }
}
