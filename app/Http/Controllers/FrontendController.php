<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\GalleryImage;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.pages.index');
    }
    public function tentang()
    {
        return view('frontend.pages.tentang');
    }
    public function berita()
    {
        $news = News::where('is_published', true)->latest()->paginate(9);
        return view('frontend.pages.berita', compact('news'));
    }
    public function detailBerita($id)
    {
        // Cari berita berdasarkan ID, 404 jika tidak ditemukan
        $item = News::findOrFail($id);

        // Tampilkan view detail
        return view('frontend.pages.berita_detail', compact('item'));
    }
    public function gallery()
    {
        $images = GalleryImage::orderBy('order')->get();
        return view('frontend.pages.galery', compact('images'));
    }
    public function kontak()
    {
        return view('frontend.pages.kontak');
    }
}
