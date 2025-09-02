@extends('admin.layouts.app')

@section('title', 'Manajemen Galeri')

@section('content')
    <div class="container w-full h-screen px-10 py-10 mx-auto">
        <h1 class="pt-16 pb-6 text-3xl font-semibold text-black sm:pt-0">Galeri Foto</h1>

    @if (session('success'))
        <div class="px-4 py-3 mb-6 text-green-400 bg-green-100 border border-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.gallery.create') }}" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
            + Tambah Foto
        </a>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        @foreach ($images as $image)
            <div class="overflow-hidden transition-all duration-300 bg-white rounded-lg shadow-lg hover:shadow-xl">
                <!-- Gambar -->
                <div class="relative">
                    <img 
                        src="{{ Storage::url('gallery/' . $image->image) }}" 
                        alt="{{ $image->caption ?? 'Gambar galeri' }}" 
                        class="object-cover w-full h-48">
                    
                    <!-- Badge Status -->
                    @if ($image->is_featured)
                        <span class="absolute px-2 py-1 text-xs font-bold text-white bg-blue-500 rounded-full top-2 right-2">
                            Utama
                        </span>
                    @endif
                </div>

                <!-- Info Bawah Gambar -->
                <div class="p-3 bg-gray-50">
                    <!-- Caption -->
                    <p class="text-xs text-center text-gray-700 truncate" title="{{ $image->caption }}">
                        {{ $image->caption ?: 'Tanpa keterangan' }}
                    </p>

                    <!-- Status: Gambar Utama -->
                    @if ($image->is_featured)
                        <span class="block px-2 py-1 mt-1 text-xs text-center text-white bg-blue-500 rounded">
                            Utama
                        </span>
                    @else
                        <span class="block px-2 py-1 mt-1 text-xs text-center text-gray-500 bg-gray-200 rounded">
                            Biasa
                        </span>
                    @endif

                    <!-- Urutan -->
                    <p class="mt-1 text-xs text-center text-gray-400">
                        Urutan: {{ $image->order }}
                    </p>
                </div>

                <!-- Tombol di bawah box -->
                <div class="flex justify-center px-3 py-2 space-x-2 bg-gray-100 border-t border-gray-200">
                    <a href="{{ route('admin.gallery.edit', $image->id) }}" class="">
                        <i class="mr-1 fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('admin.gallery.destroy', $image->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin hapus foto ini?')" class="">
                            <i class="mr-1 fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Jika tidak ada gambar -->
    @if ($images->isEmpty())
        <div class="py-10 text-center text-gray-500">
            <p>Tidak ada foto di galeri.</p>
        </div>
    @endif
    </div>
@endsection