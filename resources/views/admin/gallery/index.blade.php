
@php
    // Helper untuk highlight teks di galeri
    if (!function_exists('highlightGalleryText')) {
        function highlightGalleryText($text, $search) {
            if (empty($search) || empty($text)) {
                return $text;
            }
            
            $searchTerms = explode(' ', $search);
            $highlightedText = $text;
            
            foreach ($searchTerms as $term) {
                if (strlen($term) > 2) {
                    $pattern = '/(' . preg_quote($term, '/') . ')/i';
                    $highlightedText = preg_replace($pattern, '<span class="bg-yellow-200 font-medium px-1 rounded">$1</span>', $highlightedText);
                }
            }
            
            return $highlightedText;
        }
    }
@endphp


@extends('admin.layouts.app')

@section('title', 'Manajemen Galeri')

@section('content')
    <div class="w-full min-h-screen px-6 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">Manajemen Galeri</h1>
                    <p class="text-gray-500 mt-1">Kelola koleksi foto dan gambar</p>
                </div>
                
                <!-- Statistik -->
                <div class="flex items-center space-x-4">
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm font-medium">
                        {{ $images->count() }} foto
                    </span>
                </div>
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

        <!-- Pencarian dan Filter -->
        <div class="bg-white rounded-xl border border-gray-100 p-4 mb-6">
            <form method="GET" action="{{ route('admin.gallery.index') }}" class="space-y-4">
                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Input Pencarian -->
                    <div class="flex-1">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                            <input type="text" 
                                   name="search" 
                                   value="{{ request('search') }}"
                                   placeholder="Cari caption foto..." 
                                   class="pl-10 pr-4 py-2.5 w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                   autocomplete="off">
                            
                            @if(request()->has('search') && !empty(request('search')))
                                <a href="{{ route('admin.gallery.index') }}" 
                                   class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Filter Status -->
                    <div class="w-full md:w-48">
                        <select name="status" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">Semua Status</option>
                            <option value="featured" {{ request('status') == 'featured' ? 'selected' : '' }}>Publikasi</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                    
                    <!-- Tombol Cari -->
                    <div class="flex space-x-2">
                        <button type="submit"
                                class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium flex items-center justify-center whitespace-nowrap">
                            <i class="fas fa-search mr-2"></i>
                            Cari
                        </button>
                        
                        <!-- Tombol Reset -->
                        @if(request()->has('search') || request()->has('status'))
                            <a href="{{ route('admin.gallery.index') }}"
                               class="px-4 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-medium flex items-center justify-center">
                                <i class="fas fa-redo mr-2"></i>
                                Reset
                            </a>
                        @endif
                    </div>
                </div>
                
                <!-- Info Pencarian Aktif -->
                @if(request()->has('search') || request()->has('status'))
                    <div class="flex flex-wrap items-center gap-2 text-sm text-gray-600">
                        <div class="flex items-center">
                            <i class="fas fa-filter mr-2"></i>
                            Filter aktif:
                        </div>
                        
                        @if(request()->has('search') && !empty(request('search')))
                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-xs font-medium">
                                Pencarian: "{{ request('search') }}"
                            </span>
                        @endif
                        
                        @if(request()->has('status'))
                            @php
                                $statusLabel = request('status') == 'featured' ? 'Publikasi' : 'Draft';
                            @endphp
                            <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded text-xs font-medium">
                                Status: {{ $statusLabel }}
                            </span>
                        @endif
                    </div>
                @endif
            </form>
        </div>

        <!-- Tombol Tambah dan Statistik -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <div>
                @if(request()->has('search') && !empty(request('search')))
                    <p class="text-sm text-gray-600">
                        Menampilkan <span class="font-medium">{{ $images->count() }}</span> hasil untuk pencarian "{{ request('search') }}"
                    </p>
                @elseif(request()->has('status'))
                    <p class="text-sm text-gray-600">
                        Menampilkan <span class="font-medium">{{ $images->count() }}</span> foto dengan status {{ request('status') == 'featured' ? 'publikasi' : 'draft' }}
                    </p>
                @endif
            </div>
            
            <!-- Tombol Tambah -->
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('admin.gallery.create') }}" 
                   class="flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 text-white font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Foto
                </a>
            </div>
        </div>

        <!-- Grid Galeri -->
        @if($images->count() > 0)
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($images as $image)
                    <div class="bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <!-- Gambar -->
                        <div class="relative">
                            <img 
                                src="{{ Storage::url('gallery/' . $image->image) }}" 
                                alt="{{ $image->caption ?? 'Gambar galeri' }}" 
                                class="w-full h-48 object-cover">

                            <!-- Badge Status Publikasi -->
                            <span class="absolute top-3 right-3 px-2.5 py-1 text-xs font-medium rounded-full shadow-sm flex items-center space-x-1
                                @if($image->is_featured)
                                    bg-green-600 text-white
                                @else
                                    bg-yellow-500 text-white
                                @endif">
                                <i class="@if($image->is_featured) fas fa-check-circle @else fas fa-clock @endif text-xs"></i>
                                <span>{{ $image->is_featured ? 'Publikasi' : 'Draft' }}</span>
                            </span>
                        </div>

                        <!-- Info Bawah Gambar -->
                        <div class="p-4 bg-gray-50">
                            <!-- Caption -->
                            <p class="text-sm font-medium text-gray-800 text-center truncate" title="{{ $image->caption }}">
                                @if(request()->has('search') && !empty(request('search')))
                                    {!! highlightGalleryText($image->caption ?: 'Tanpa keterangan', request('search')) !!}
                                @else
                                    {{ $image->caption ?: 'Tanpa keterangan' }}
                                @endif
                            </p>

                            <!-- Urutan -->
                            <p class="mt-3 text-xs text-center text-gray-500">
                                <i class="fas fa-sort-numeric-up mr-1"></i> Urutan: {{ $image->order }}
                            </p>
                            
                            <!-- Uploader -->
                            @if($image->uploader)
                                <p class="mt-2 text-xs text-center text-gray-500">
                                    <i class="fas fa-user mr-1"></i> {{ $image->uploader->name }}
                                </p>
                            @endif
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="flex justify-center gap-2 p-4 bg-gray-100 border-t border-gray-200">
                            <a href="{{ route('admin.gallery.edit', $image->id) }}" 
                               class="flex items-center px-3 py-2 text-sm font-medium text-indigo-600 bg-white border border-indigo-200 rounded-lg hover:bg-indigo-50 hover:text-indigo-700 transition-colors">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            <form action="{{ route('admin.gallery.destroy', $image->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Yakin ingin menghapus foto ini?')"
                                        class="flex items-center px-3 py-2 text-sm font-medium text-red-600 bg-white border border-red-200 rounded-lg hover:bg-red-50 hover:text-red-700 transition-colors">
                                    <i class="fas fa-trash mr-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Tidak ada data -->
            <div class="bg-white rounded-xl border border-gray-100 p-8 text-center">
                <div class="inline-flex flex-col items-center justify-center">
                    @if(request()->has('search') || request()->has('status'))
                        <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-700 mb-1">Tidak ditemukan</h3>
                        <p class="text-sm text-gray-500 mb-6">
                            @if(request()->has('search') && !empty(request('search')))
                                Tidak ada foto yang cocok dengan pencarian "{{ request('search') }}"
                            @elseif(request()->has('status'))
                                Tidak ada foto dengan status {{ request('status') == 'featured' ? 'publikasi' : 'draft' }}
                            @endif
                        </p>
                        <a href="{{ route('admin.gallery.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors font-medium">
                            <i class="fas fa-redo mr-2"></i>
                            Tampilkan Semua Foto
                        </a>
                    @else
                        <i class="fas fa-images text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-700 mb-1">Belum ada foto di galeri</h3>
                        <p class="text-sm text-gray-500 mb-6">Silakan tambahkan foto pertama Anda.</p>
                        <a href="{{ route('admin.gallery.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Foto Pertama
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </div>
@endsection