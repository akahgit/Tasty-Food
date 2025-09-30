@extends('admin.layouts.app')

@section('title', 'Edit Map')

@section('content')
    <div class="w-full min-h-screen">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-2">
                <a href="{{ route('admin.dashboard') }}" 
                   class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-2xl font-semibold text-gray-900">Pengaturan Peta</h1>
            </div>
        </div>

        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="px-4 py-3 mb-6 text-green-700 bg-green-100 border-l-4 border-green-500 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('admin.map.update') }}" method="POST" class="max-w-4xl">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Konten Utama -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Judul Peta -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-heading text-gray-400 mr-2"></i>
                            Informasi Peta
                        </h3>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Judul Peta
                            </label>
                            <input type="text" 
                                   name="title" 
                                   value="{{ old('title', $map->title ?? '') }}"
                                   placeholder="Masukkan judul peta..."
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors @error('title') border-red-300 @enderror">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Embed URL -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-code text-gray-400 mr-2"></i>
                            Google Maps Embed URL
                        </h3>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                URL Embed
                            </label>
                            <textarea name="embed_url" 
                                      rows="6"
                                      placeholder="https://www.google.com/maps/embed?pb=..."
                                      class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors resize-vertical @error('embed_url') border-red-300 @enderror">{{ old('embed_url', $map->embed_url ?? '') }}</textarea>
                            <p class="mt-2 text-xs text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Dapatkan dari Google Maps → Share → Embed a map
                            </p>
                            @error('embed_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Preview Peta -->
                    @if(isset($map->embed_url) && $map->embed_url)
                        <div class="bg-white rounded-xl border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                <i class="fas fa-map-marked-alt text-gray-400 mr-2"></i>
                                Preview Peta
                            </h3>
                            <div class="w-full h-auto rounded-lg overflow-hidden border border-gray-200">
                                <iframe 
                                    src="{{ $map->embed_url }}" 
                                    width="100%" 
                                    height="100%" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade"
                                    class="rounded-md">
                                </iframe>
                            </div>
                            <p class="mt-3 text-xs text-gray-500 text-center">
                                Tampilan mungkin berbeda di frontend
                            </p>
                        </div>
                    @endif

                    <!-- Tips -->
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-lightbulb text-blue-600 mt-0.5"></i>
                            <div>
                                <p class="text-sm font-medium text-blue-800">Tips:</p>
                                <p class="text-xs text-blue-700 mt-1">
                                    Pastikan URL diambil dari opsi "Embed a map" di Google Maps
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Submit -->
                    <button type="submit" 
                            class="flex items-center justify-center w-full px-6 py-3 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 text-white font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection