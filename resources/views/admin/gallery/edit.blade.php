@extends('admin.layouts.app')

@section('title', 'Edit Foto Galeri')

@section('content')
    <div class="container w-full h-screen px-10 py-10 mx-auto">
         <h1 class="pb-6 text-3xl text-black">Edit Foto</h1>

    <form action="{{ route('admin.gallery.update', $image->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <div>
                <label class="block font-semibold">Gambar Saat Ini</label>
                <div class="mb-2">
                    <img src="{{ Storage::url('gallery/' . $image->image) }}" alt="Gambar"
                        class="object-cover w-32 h-32 rounded">
                </div>
                <input type="file" name="image" class="w-full p-2 border rounded-md">
                <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin ganti gambar</p>
            </div>

            <div>
                <label class="block font-semibold">Keterangan</label>
                <input type="text" name="caption" value="{{ old('caption', $image->caption) }}"
                    class="w-full p-3 border rounded-md">
            </div>

            <div>
                <label class="block font-semibold">Urutan</label>
                <input type="number" name="order" value="{{ old('order', $image->order) }}"
                    class="w-full p-3 border rounded-md">
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

        <div class="mt-8">
            <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                Perbarui Foto
            </button>
        </div>
    </form>
    </div>
@endsection
