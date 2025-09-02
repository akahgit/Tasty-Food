@extends('admin.layouts.app')

@section('title', 'Edit Map')

@section('content')
<div class="container px-4 py-6 mx-auto sm:px-6 lg:px-8 lg:py-8">
    <h1 class="mb-4 text-xl font-bold text-gray-800 sm:mb-6 sm:text-2xl">Pengaturan Peta</h1>

    @if (session('success'))
        <div class="px-4 py-3 mb-6 text-green-700 bg-green-100 border border-green-200 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="max-w-4xl">
        <form action="{{ route('admin.map.update') }}" method="POST" class="space-y-4 sm:space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" 
                       class="block mb-2 text-sm font-medium text-gray-700 sm:text-base">
                    Judul
                </label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ old('title', $map->title ?? '') }}" 
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 sm:px-4 sm:text-base"
                    placeholder="Masukkan judul peta"
                >
                @error('title')
                    <span class="block mt-1 text-xs text-red-500 sm:text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="embed_url" 
                       class="block mb-2 text-sm font-medium text-gray-700 sm:text-base">
                    Google Maps Embed URL
                </label>
                <textarea 
                    id="embed_url" 
                    name="embed_url" 
                    rows="4"
                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md resize-vertical focus:ring-blue-500 focus:border-blue-500 sm:px-4 sm:text-base sm:rows-6"
                    placeholder="https://www.google.com/maps/embed?pb=..."
                >{{ old('embed_url', $map->embed_url ?? '') }}</textarea>
                <p class="mt-1 text-xs text-gray-500 sm:text-sm">
                    Dapatkan dari Google Maps → Share → Embed a map
                </p>
                @error('embed_url')
                    <span class="block mt-1 text-xs text-red-500 sm:text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Preview Map (jika ada URL) -->
            @if(isset($map->embed_url) && $map->embed_url)
                <div class="p-4 rounded-md bg-gray-50">
                    <h3 class="mb-2 text-sm font-medium text-gray-700 sm:text-base">Preview Peta:</h3>
                    <div class="w-full h-48 overflow-hidden rounded-md sm:h-64 lg:h-80">
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
                </div>
            @endif

            <div class="pt-2 sm:pt-4">
                <button 
                    type="submit" 
                    class="w-full px-6 py-2 text-sm font-medium text-white transition-colors bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:w-auto sm:text-base"
                >
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.dashboard') }}" 
                   class="inline-block w-full px-6 py-2 mt-3 text-sm font-medium text-center text-gray-700 transition-colors bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 sm:w-auto sm:ml-3 sm:mt-0 sm:text-base">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection