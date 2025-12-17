<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\JsonResponse;

class ApiGalleryController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $images = GalleryImage::with('uploader')
                ->orderBy('order')
                ->orderBy('created_at', 'desc')
                ->get();

            $data = $images->map(function ($image) {
                return [
                    'id' => $image->id,
                    'image' => $image->image ? asset('storage/gallery/' . $image->image) : null,
                    'caption' => $image->caption,
                    'order' => $image->order,
                    'is_featured' => $image->is_featured,
                    'uploaded_by' => $image->uploader?->name,
                    'created_at' => $image->created_at->format('d M Y')
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Data gallery berhasil diambil',
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
}