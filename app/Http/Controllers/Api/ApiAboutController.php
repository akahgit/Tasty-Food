<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\JsonResponse;

class ApiAboutController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $about = About::first();
            
            if (!$about) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tentang tidak ditemukan',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data tentang berhasil diambil',
                'data' => [
                    'description' => $about->description,
                    'vision' => $about->vision,
                    'mission' => $about->mission,
                    'image_1' => $about->image_1 ? asset('storage/about/' . $about->image_1) : null,
                    'image_2' => $about->image_2 ? asset('storage/about/' . $about->image_2) : null,
                    'last_updated' => $about->updated_at?->format('d M Y'),
                    'updated_by' => $about->updater?->name
                ]
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