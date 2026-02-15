<?php

// app/Http/Controllers/PopupController.php

namespace App\Http\Controllers;

use App\Models\Popup;
use Illuminate\Http\Request;

class PopupController extends Controller
{
    public function index()
    {
        $popups = Popup::all();
        return view('popups.index', compact('popups'));
    }

    public function create()
    {
        return view('popups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image',
            'view' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'active' => 'required|boolean',
            'repeat_days' => 'nullable|array',
            'repeat_days.*' => 'integer|between:0,6',
        ]);

        $data = $request->all();
        $data['repeat_days'] = is_array($request->input('repeat_days'))
            ? implode(',', $request->input('repeat_days'))
            : null;
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('popups', 'public');
        }

        Popup::create($data);

        return redirect()->route('popups.index')->with('success', 'Pop-up creado con éxito.');
    }

    public function edit(Popup $popup)
    {
        return view('popups.edit', compact('popup'));
    }

    public function update(Request $request, Popup $popup)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image',
            'view' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'active' => 'required|boolean',
            'repeat_days' => 'nullable|array',
            'repeat_days.*' => 'integer|between:0,6',
        ]);

        $data = $request->all();
        $data['repeat_days'] = is_array($request->input('repeat_days'))
            ? implode(',', $request->input('repeat_days'))
            : null;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('popups', 'public');
        }

        $popup->update($data);

        return redirect()->route('popups.index')->with('success', 'Pop-up actualizado con éxito.');
    }

    public function destroy(Popup $popup)
    {
        $popup->delete();

        return redirect()->route('popups.index')->with('success', 'Pop-up eliminado con éxito.');
    }
}
