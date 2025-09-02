@extends('frontend.layouts.innerNavbar.navbar')

@section('title', $item->title)
@section('hero-bg', 'bg-hero-tentang')
@section('hero-title', 'BERITA DETAIL')

@section('content')
    <main class="container px-4 py-8 mx-auto sm:px-5 lg:px-20 sm:py-12 lg:py-16">
        
        <!-- Breadcrumb -->
        <nav class="mb-6 text-sm text-gray-600">
            <a href="{{ route('frontend.index') }}" class="hover:underline">Home</a>
            |
            <a href="{{ route('frontend.berita') }}" class="hover:underline">Berita</a>
            |
            <span>{{ Str::limit($item->title, 30) }}</span>
        </nav>

        <!-- Judul -->
        <h1 class="mb-4 text-2xl font-bold text-black sm:text-3xl">
            {{ $item->title }}
        </h1>

        <!-- Tanggal -->
        <p class="mb-6 text-sm text-gray-500">
            Dipublikasikan pada: {{ $item->created_at->format('d M Y, H:i') }}
        </p>

        <!-- Gambar Utama dengan Fallback -->
        <div class="mb-8 overflow-hidden rounded-lg shadow-md">
            <img 
                src="{{ $item->image ? Storage::url('news/' . $item->image) : asset('images/img-1.webp') }}"
                alt="{{ $item->title ?? 'Berita Tasty Food' }}" 
                class="object-cover w-full h-64 transition-transform duration-300 sm:h-80 lg:h-96 hover:scale-105"
                loading="lazy">
        </div>

        <!-- Konten Berita -->
        <article class="leading-relaxed prose prose-lg text-gray-700 max-w-none">
            {{ $item->content }}
        </article>

        <!-- Tombol Kembali -->
        <div class="mt-10">
            <a href="{{ route('frontend.berita') }}" 
               class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-black rounded hover:bg-gray-800 transition">
                Kembali ke Berita
            </a>
        </div>

    </main>
@endsection