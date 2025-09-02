<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    // Tampilkan semua foto
    public function index()
    {
        $images = GalleryImage::with('uploader')->orderBy('order')->get();
        return view('admin.gallery.index', compact('images'));
    }

    // Form tambah foto
    public function create()
    {
        return view('admin.gallery.create');
    }

    // Simpan foto baru
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
            'caption' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_featured' => 'boolean',
        ]);

        $file = $request->file('image');
        $filename = 'gallery_' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/gallery', $filename);

        $image = new GalleryImage();
        $image->image = $filename;
        $image->caption = $request->caption;
        $image->order = $request->order ?? 0;
        $image->is_featured = $request->has('is_featured');
        $image->uploaded_by = Auth::id();
        $image->save();

        return redirect()->route('admin.gallery.index')->with('success', 'Foto berhasil ditambahkan!');
    }

    // Form edit
    public function edit($id)
    {
        $image = GalleryImage::findOrFail($id);
        return view('admin.gallery.edit', compact('image'));
    }

    // Update foto
    public function update(Request $request, $id)
    {
        $image = GalleryImage::findOrFail($id);

        $request->validate([
            'caption' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|max:2048',
            // Hapus validasi 'is_featured' => 'boolean' jika pakai hidden input
        ]);

        $image->caption = $request->caption;
        $image->order = $request->order ?? 0;

        // ✅ Ambil nilai langsung, jangan pakai has()
        $image->is_featured = (bool) $request->input('is_featured', false);

        // Upload gambar baru
        if ($request->hasFile('image')) {
            if ($image->image && Storage::exists('public/gallery/' . $image->image)) {
                Storage::delete('public/gallery/' . $image->image);
            }

            $file = $request->file('image');
            $filename = 'gallery_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/gallery', $filename);
            $image->image = $filename;
        }

        $image->save();

        return redirect()->route('admin.gallery.index')->with('success', 'Foto berhasil diperbarui!');
    }

    // Hapus gambar
    public function destroy($id)
    {
        $image = GalleryImage::findOrFail($id);

        // Hapus gambar dari storage
        if ($image->image && Storage::exists('public/gallery/' . $image->image)) {
            Storage::delete('public/gallery/' . $image->image);
        }

        $image->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Foto berhasil dihapus!');
    }
}
