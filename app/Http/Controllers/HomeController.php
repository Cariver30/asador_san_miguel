<?php

// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Popup;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return redirect()->route('cover');
    }

    public function cover()
    {
        $settings = Setting::first();
        $popups = Popup::where('active', 1)
            ->where('view', 'cover')
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->get();
        $chefCategories = Category::query()
            ->where(function ($query) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%chef%'])
                    ->orWhereRaw('LOWER(name) LIKE ?', ['%especial%']);
            })
            ->with(['dishes' => function ($query) {
                $query->where('visible', true)
                    ->orderBy('position')
                    ->orderBy('id');
            }])
            ->orderBy('order')
            ->get()
            ->filter(function ($category) {
                return $category->dishes->isNotEmpty();
            })
            ->values();

        return view('cover', compact('settings', 'chefCategories', 'popups'));
    }

    public function menu()
    {
        $settings = Setting::first();
        $categories = Category::with('dishes')->get();
        return view('menu', compact('settings', 'categories'));
    }
}
