<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('author')->latest()->get();
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
        ]);

        $news = new News();
        $news->title = $request->title;
        $news->content = $request->content;
        $news->is_published = (bool) $request->input('is_published', false);
        $news->created_by = Auth::id();

        // upload gambar

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'news_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/news', $filename);
            $news->image = $filename;
        }

        $news->save();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil di tambahklan');
    }


    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    // update berita
    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
        ]);

        $news->title = $request->title;
        $news->content = $request->content;
        $news->is_published = (bool) $request->input('is_published', false);

        // update gambar baru
        if ($request->hasFile('image')) {
            // hapus gambar lama
            if ($news->image && Storage::exists('public/news/' . $news->image)) {
                Storage::delete('public/news/' . $news->image);
            }

            $file = $request->file('image');
            $filename = 'news_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/news', $filename);
            $news->image = $filename;
        }

        $news->save();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil di perbarui');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);

        // hapus gambar
        if ($news->image && Storage::exists('public/news/' . $news->image)) {
            Storage::delete('public/news/' . $news->image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil di hapus');
    }
}
