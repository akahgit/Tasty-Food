<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\JsonResponse;

class ApiNewsController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $news = News::where('is_published', true)
                ->with('author')
                ->orderBy('created_at', 'desc')
                ->get();

            $data = $news->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'excerpt' => $this->excerpt($item->content, 100),
                    'content' => $item->content,
                    'image' => $item->image ? asset('storage/news/' . $item->image) : null,
                    'is_published' => $item->is_published,
                    'author' => $item->author?->name,
                    'created_at' => $item->created_at->format('d M Y'),
                    'updated_at' => $item->updated_at->format('d M Y')
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Data berita berhasil diambil',
                'data' => $data
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $news = News::where('is_published', true)
                ->with('author')
                ->find($id);

            if (!$news) {
                return response()->json([
                    'success' => false,
                    'message' => 'Berita tidak ditemukan',
                    'data' => null
                ], 404);
            }

            $data = [
                'id' => $news->id,
                'title' => $news->title,
                'content' => $news->content,
                'image' => $news->image ? asset('storage/news/' . $news->image) : null,
                'is_published' => $news->is_published,
                'author' => $news->author?->name,
                'created_at' => $news->created_at->format('d M Y'),
                'updated_at' => $news->updated_at->format('d M Y')
            ];

            return response()->json([
                'success' => true,
                'message' => 'Detail berita berhasil diambil',
                'data' => $data
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function excerpt($text, $length = 100): string
    {
        if (strlen($text) <= $length) {
            return $text;
        }
        
        $excerpt = substr($text, 0, $length);
        $lastSpace = strrpos($excerpt, ' ');
        
        if ($lastSpace !== false) {
            $excerpt = substr($excerpt, 0, $lastSpace);
        }
        
        return $excerpt . '...';
    }
}