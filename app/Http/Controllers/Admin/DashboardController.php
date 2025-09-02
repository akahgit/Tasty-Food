<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Http\Controllers\Controller;
use App\Models\GalleryImage;

class DashboardController extends Controller
{
    public function index() {
        $totalMessages = ContactMessage::count();
    $unreadMessages = ContactMessage::where('read', false)->count();
    $totalNews = News::count();
    $totalGallery = GalleryImage::count();

    $latestMessages = ContactMessage::latest()->take(5)->get();

    return view('admin.dashboard', compact('totalMessages', 'unreadMessages', 'totalNews', 'totalGallery', 'latestMessages'));
    }
}
