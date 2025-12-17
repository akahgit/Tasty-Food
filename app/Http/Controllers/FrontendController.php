<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    public function index()
    {
        $showSearch = false;
        return view('frontend.pages.index', compact('showSearch'));
    }
    
    public function tentang()
    {
        $showSearch = false;
        return view('frontend.pages.tentang', compact('showSearch'));
    }
    
    public function berita(Request $request)
{
    $searchTerm = $request->query('q', '');
    $showSearch = true;
    
    // Query untuk berita
    $query = News::where('is_published', true);
    
    // Jika ada search term
    if (!empty($searchTerm)) {
        $query->where(function($q) use ($searchTerm) {
            $q->where('title', 'like', "%{$searchTerm}%")
              ->orWhere('content', 'like', "%{$searchTerm}%");
        });
    }
    
    $news = $query->latest()->paginate(9);
    
    // Tambahkan parameter search ke pagination
    if (!empty($searchTerm)) {
        $news->appends(['q' => $searchTerm]);
    }
    
    return view('frontend.pages.berita', compact('news', 'showSearch', 'searchTerm'));
}
    
    public function detailBerita($id)
    {
        $item = News::findOrFail($id);
        $showSearch = true;
        
        // Ambil berita terkait (opsional)
        $relatedNews = News::where('is_published', true)
                          ->where('id', '!=', $id)
                          ->latest()
                          ->take(3)
                          ->get();
        
        return view('frontend.pages.berita_detail', compact('item', 'showSearch', 'relatedNews'));
    }
    
    public function gallery()
    {
        $images = GalleryImage::where('is_featured', true)
            ->orderBy('order')
            ->get();
        $showSearch = false;
        return view('frontend.pages.galery', compact('images', 'showSearch'));
    }
    
    public function kontak()
    {
        $showSearch = false;
        return view('frontend.pages.kontak', compact('showSearch'));
    }
}