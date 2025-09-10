@extends('admin.layouts.app')
@section('content')
    <h1 class="pb-6 text-3xl text-black">Tambah Berita Baru</h1>

    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div class="space-y-6">
                <div>
                    <label class="block font-semibold">Judul</label>
                    <input type="text" name="title" class="w-full p-3 border rounded-md" required>
                </div>

                <div>
                    <label class="block font-semibold">Isi Berita</label>
                    <textarea name="content" cols="10" class="w-full p-3 border rounded-md" required></textarea>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block font-semibold">Gambar</label>
                        <input type="file" name="image" class="w-full p-2 border rounded-md">
                        <p class="mt-1 text-xs text-gray-500">Max 2MB, format: jpg, png, webp</p>
                    </div>

                    <div class="flex items-center">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" name="is_published" value="1" id="is_published" class="mr-2"
                            {{ old('is_published', $news->is_published ?? false) ? 'checked' : '' }}>
                        <label for="is_published" class="font-semibold">Publikasikan</label>
                    </div>
                    <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                        Simpan Berita
                    </button>
                    <a href="{{ route('admin.news.index') }}" class="inline-block px-6 py-2 text-sm text-blue-600 border border-blue-600 rounded hover:bg-blue-600 hover:text-white">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </form>
@endsection
