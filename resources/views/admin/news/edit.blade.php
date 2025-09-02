@extends('admin.layouts.app')

@section('title', 'Edit Berita')

@section('content')
    <h1 class="pb-6 text-3xl text-black">Edit Berita</h1>

    <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div class="space-y-4">
                <div>
                    <label class="block font-semibold">Judul</label>
                    <input type="text" name="title" value="{{ old('title', $news->title) }}"
                        class="w-full p-3 border rounded-md" required>
                </div>

                <div>
                    <label class="block font-semibold">Isi Berita</label>
                    <textarea name="content" rows="10" class="w-full p-3 border rounded-md" required>{{ old('content', $news->content) }}</textarea>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block font-semibold">Gambar Saat Ini</label>
                    @if ($news->image)
                        <div class="mb-2">
                            <img src="{{ Storage::url('news/' . $news->image) }}" alt="Gambar berita"
                                class="object-cover w-32 h-32 rounded">
                        </div>
                    @endif
                    <input type="file" name="image" class="w-full p-2 border rounded-md">
                    <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin ganti gambar</p>
                </div>

                <div class="flex items-center">
                    <!-- Hidden input selalu kirim 0 jika tidak dicentang -->
                    <input type="hidden" name="is_published" value="0">

                    <!-- Checkbox kirim 1 jika dicentang -->
                    <input type="checkbox" name="is_published" value="1" id="is_published" class="mr-2"
                        {{ old('is_published', $news->is_published) ? 'checked' : '' }}>

                    <label for="is_published" class="font-semibold">Publikasikan</label>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
                Perbarui Berita
            </button>
        </div>
    </form>
@endsection
