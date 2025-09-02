@extends('admin.layouts.app')

@section('title', 'Tambah Foto Galeri')

@section('content')
    <div class="container w-full h-screen px-10 py-10 mx-auto">
        <h1 class="pb-6 text-3xl text-black">Tambah Foto Baru</h1>

    @if ($errors->any())
        <div class="px-4 py-3 mb-6 text-red-400 bg-red-100 border border-red-700 rounded">
            <ul class="pl-5 list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="space-y-6">
            <div>
                <label class="block font-semibold">Gambar</label>
                <input type="file" name="image" class="w-full p-2 border rounded-md" required>
                <p class="mt-1 text-xs text-gray-500">Max 2MB, format: jpg, png, webp</p>
            </div>

            <div>
                <label class="block font-semibold">Keterangan (Opsional)</label>
                <input type="text" name="caption" class="w-full p-3 border rounded-md">
            </div>

            <div>
                <label class="block font-semibold">Urutan</label>
                <input type="number" name="order" value="0" class="w-full p-3 border rounded-md">
            </div>

            <div class="flex items-center">
                <!-- Hidden input kirim 0 jika tidak dicentang -->
                <input type="hidden" name="is_featured" value="0">

                <!-- Checkbox kirim 1 jika dicentang -->
                <input type="checkbox" name="is_featured" value="1" id="is_featured" class="mr-2"
                    {{ old('is_featured', $image->is_featured ?? false) ? 'checked' : '' }}>

                <label for="is_featured" class="font-semibold">Gambar Utama</label>
            </div>
        </div>

        <div class="flex w-full gap-5 mt-8">
            <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                Simpan Foto
            </button>
            <a href="{{ route('admin.gallery.index') }}" class="px-6 py-2 text-white bg-green-600 rounded hover:bg-green-700">Kembali</a>
        </div>
    </form>
    </div>
@endsection
