<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Map;
use Illuminate\Http\JsonResponse;

class ApiMapController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $map = Map::first();

            if (!$map) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data maps tidak ditemukan',
                    'data' => null
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data maps berhasil diambil',
                'data' => [
                    'id' => $map->id,
                    'title' => $map->title,
                    'embed_url' => $map->embed_url,
                    'created_at' => $map->created_at->format('d M Y'),
                    'updated_at' => $map->updated_at->format('d M Y')
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