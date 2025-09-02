<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function edit()
    {
        // Ambil data about, jika belum ada, buat data baru
        $about = About::first();
        if (!$about) {
            $about = About::create();
        }
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $about = About::first();
        if (!$about) {
            $about = new About();
        }

        $request->validate([
            'description' => 'nullable|string',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',
            'image_1' => 'nullable|image|max:2048',
            'image_2' => 'nullable|image|max:2048',
        ]);

        // Update teks
        $about->description = $request->description;
        $about->vision = $request->vision;
        $about->mission = $request->mission;
        $about->updated_by = Auth::id();

        // Upload gambar 1
        if ($request->hasFile('image_1')) {
            if ($about->image_1 && Storage::exists('public/about/' . $about->image_1)) {
                Storage::delete('public/about/' . $about->image_1);
            }

            $file = $request->file('image_1');
            $filename = 'image1_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/about', $filename);
            $about->image_1 = $filename;
        }

        // Upload gambar 2
        if ($request->hasFile('image_2')) {
            if ($about->image_2 && Storage::exists('public/about/' . $about->image_2)) {
                Storage::delete('public/about/' . $about->image_2);
            }

            $file = $request->file('image_2');
            $filename = 'image2_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/about', $filename);
            $about->image_2 = $filename;
        }

        $about->save();

        return redirect()->back()->with('success', 'Data tentang berhasil diperbarui.');
    }
}
