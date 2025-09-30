@extends('admin.layouts.app')

@section('title', 'Manajemen Galeri')

@section('content')
    <div class="w-full min-h-screen px-6 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-semibold text-gray-900">Manajemen Galeri</h1>
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

        <!-- Tombol Tambah -->
        <div class="flex justify-end mb-8">
            <a href="{{ route('admin.gallery.create') }}" 
               class="flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 text-white font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                <i class="fas fa-plus mr-2"></i>
                Tambah Foto
            </a>
        </div>

        <!-- Grid Galeri -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @forelse ($images as $image)
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
                            {{ $image->caption ?: 'Tanpa keterangan' }}
                        </p>

                        <!-- Urutan -->
                        <p class="mt-3 text-xs text-center text-gray-500">
                            <i class="fas fa-sort-numeric-up mr-1"></i> Urutan: {{ $image->order }}
                        </p>
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
            @empty
                <!-- Tidak ada data -->
                <div class="col-span-full py-12 text-center">
                    <div class="inline-flex flex-col items-center justify-center p-6 bg-gray-50 rounded-xl">
                        <i class="fas fa-images text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-700 mb-1">Belum ada foto di galeri</h3>
                        <p class="text-sm text-gray-500">Silakan tambahkan foto pertama Anda.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection