@extends('frontend.layouts.innerNavbar.navbar')

@section('title', 'Berita kami')
@section('hero-bg', 'bg-hero-tentang')
@section('hero-title', 'BERITA KAMI')

@section('content')
    <main class="container min-h-screen px-4 mx-auto sm:px-6 lg:px-8">
        <!-- Section: Berita Utama (Hanya tampil jika TIDAK sedang search) -->
        @if ($news->isNotEmpty() && empty($searchTerm))
        <section class="relative flex items-center justify-center min-h-screen py-10 lg:py-20">
            @php $featured = $news->first(); @endphp
            <div class="grid w-full grid-cols-1 gap-8 max-w-7xl lg:grid-cols-2 lg:gap-12">
                <div class="order-2 px-4 lg:order-1 sm:px-8 lg:px-24">
                    <img src="{{ $featured->image ? Storage::url('news/' . $featured->image) : asset('images/img-1.webp') }}"
                        alt="{{ $featured->title }}"
                        class="transform w-full max-w-[500px] h-[300px] sm:h-[350px] lg:h-[400px] rounded-xl object-cover object-center mx-auto transition duration-300 hover:scale-105"
                        loading="lazy">
                </div>
                <div class="order-1 px-4 space-y-4 sm:space-y-5 lg:order-2 sm:px-6">
                    <h2 class="text-2xl font-bold leading-tight text-black sm:text-3xl lg:text-4xl">
                        {{ $featured->title }}
                    </h2>
                    <p class="text-sm leading-relaxed text-black sm:text-base">
                        {{ Str::limit(strip_tags($featured->content), 1000) }}
                    </p>
                    <a href="{{ route('frontend.berita.detail', $featured->id) }}"
                        class="inline-block px-12 py-2 text-xs text-white transition bg-black rounded-lg cursor-pointer sm:px-16 lg:px-20 sm:py-3 hover:bg-gray-800 sm:text-sm lg:text-base">
                        BACA SELENGKAPNYA
                    </a>
                </div>
            </div>
        </section>
        @endif

        <!-- Section Berita -->
        <section class="px-4 mx-auto max-w-7xl sm:py-10">
            <!-- Judul dinamis -->
            <h1 class="mb-6 text-2xl font-bold sm:text-2xl md:text-3xl sm:mb-8">
                @if(!empty($searchTerm))
                    HASIL PENCARIAN
                @else
                    BERITA LAINNYA
                @endif
            </h1>

            @if ($news->isNotEmpty())
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 sm:gap-6">
                    @php
                        // LOGIKA untuk menentukan berita yang ditampilkan:
                        if (!empty($searchTerm)) {
                            // Jika sedang search: Tampilkan SEMUA berita hasil pencarian
                            $items = $news;
                        } else {
                            // Jika TIDAK search: Tampilkan berita lainnya (skip yang pertama)
                            $items = $news->skip(1);
                        }
                    @endphp
                    
                    @foreach ($items as $item)
                        <div class="flex flex-col overflow-hidden transition duration-300 transform bg-white shadow rounded-xl hover:scale-105">
                            <!-- Gambar Berita -->
                            <div class="h-32 sm:h-36">
                                <img src="{{ $item->image ? Storage::url('news/' . $item->image) : asset('images/img-1.webp') }}"
                                    alt="{{ $item->title }}" 
                                    class="object-cover object-center w-full h-full"
                                    loading="lazy">
                            </div>
                            
                            <!-- Konten Berita -->
                            <div class="flex flex-col flex-1 p-4">
                                <!-- Judul dengan highlight jika search -->
                                @if(!empty($searchTerm))
                                    <h3 class="mb-2 text-sm font-bold sm:text-base">
                                        {!! preg_replace("/($searchTerm)/i", '<mark class="bg-yellow-200 px-1 rounded">$1</mark>', e($item->title)) !!}
                                    </h3>
                                @else
                                    <h3 class="mb-2 text-sm font-bold sm:text-base">{{ $item->title }}</h3>
                                @endif
                                
                                <!-- Konten preview dengan highlight jika search -->
                                @if(!empty($searchTerm))
                                    @php
                                        $content_preview = Str::limit(strip_tags($item->content), 100);
                                        $highlighted_content = preg_replace("/($searchTerm)/i", '<mark class="bg-yellow-200 px-1 rounded">$1</mark>', e($content_preview));
                                    @endphp
                                    <p class="flex-1 text-xs text-gray-600 sm:text-sm">
                                        {!! $highlighted_content !!}
                                    </p>
                                @else
                                    <p class="flex-1 text-xs text-gray-600 sm:text-sm">
                                        {{ Str::limit(strip_tags($item->content), 100) }}
                                    </p>
                                @endif
                                
                                <!-- Footer Card -->
                                <div class="flex items-center justify-between mt-4 text-xs font-semibold sm:text-sm">
                                    <a href="{{ route('frontend.berita.detail', $item->id) }}" 
                                       class="text-yellow-400 hover:text-yellow-500 transition">
                                        Baca selengkapnya
                                    </a>
                                    <span class="text-gray-400">{{ $item->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination (jika ada lebih dari 1 halaman) -->
                @if($news->hasPages())
                <div class="flex justify-end mt-10 mb-10">
                    {{ $news->links() }}
                </div>
                @endif
                
            @else
                <!-- Jika TIDAK ADA berita yang ditemukan -->
                <div class="py-20 text-center">
                    @if(!empty($searchTerm))
                        <!-- State: Search tapi tidak ada hasil -->
                        <div class="inline-block p-6 mb-6 bg-gray-100 rounded-full">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-800">
                            Tidak ditemukan berita untuk "<span class="text-yellow-600">{{ $searchTerm }}</span>"
                        </h3>
                        <p class="mb-8 text-gray-600 max-w-md mx-auto">
                            Coba gunakan kata kunci yang berbeda atau periksa ejaan Anda.
                        </p>
                        <a href="{{ route('frontend.berita') }}" 
                           class="inline-flex items-center px-6 py-3 text-sm font-medium text-white bg-black rounded-lg hover:bg-gray-800 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Semua Berita
                        </a>
                    @else
                        <!-- State: Tidak ada berita sama sekali di database -->
                        <div class="inline-block p-6 mb-6 bg-gray-100 rounded-full">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                        <h3 class="mb-3 text-xl font-semibold text-gray-800">Belum ada berita</h3>
                        <p class="text-gray-600">Belum ada berita yang dipublikasikan.</p>
                    @endif
                </div>
            @endif
        </section>
    </main>
@endsection

@push('styles')
<style>
    mark {
        background-color: rgba(253, 224, 71, 0.5);
        padding: 0 2px;
        border-radius: 2px;
        font-weight: 600;
        animation: highlight-pulse 2s infinite;
    }
    
    @keyframes highlight-pulse {
        0%, 100% { background-color: rgba(253, 224, 71, 0.5); }
        50% { background-color: rgba(253, 224, 71, 0.8); }
    }
</style>
@endpush