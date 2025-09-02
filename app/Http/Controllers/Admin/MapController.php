<?php

namespace App\Http\Controllers\Admin;

use App\Models\Map;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapController extends Controller
{
    public function edit()
    {
        // ambil record pertama, kalau belum ada null
        $map = Map::first();

        return view('admin.map.edit', compact('map'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'embed_url' => 'required|string',
        ]);

        Map::updateOrCreate(
            ['id' => 1], // selalu pakai id=1
            [
                'title' => $request->title,
                'embed_url' => $request->embed_url,
            ]
        );

        return redirect()->back()->with('success', 'Data peta berhasil disimpan!');
    }
}
