@extends('frontend.layouts.innerNavbar.navbar')

@section('title', 'Tentang Kami')
@section('hero-bg', 'bg-hero-tentang')
@section('hero-title', 'TENTANG KAMI')

@php
    // Ambil data dari database
    $about = \App\Models\About::first();
    $about = $about ?? new \App\Models\About(); // fallback jika belum ada
@endphp

@section('content')
    <main class="container min-h-screen px-4 mx-auto sm:px-6 lg:px-8">
        <!-- Section: Deskripsi Utama -->
        <section class="w-full py-10 sm:py-15 lg:py-20">
            <div class="grid items-center grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-12">
                <!-- Teks -->
                <div class="order-2 space-y-4 sm:space-y-5 lg:order-1">
                    <h1 class="text-2xl font-bold text-black sm:text-3xl lg:text-4xl">TASTY FOOD</h1>
                    <p class="text-xs font-bold leading-relaxed text-black sm:text-sm">
                        {!! nl2br(e($about->description ?? 'Deskripsi belum diisi.')) !!}
                    </p>
                </div>

                <!-- Gambar -->
                <div
                    class="flex flex-col justify-center order-1 gap-3 transition duration-300 transform sm:flex-row sm:gap-4 lg:order-2 lg:justify-end hover:scale-105">
                    <img src="{{ $about->image_1 ? Storage::url('about/' . $about->image_1) : asset('images/brooke-lark-oaz0raysASk-unsplash.webp') }}"
                        alt="Gambar 1 - Tasty Food"
                        class="object-cover w-full h-48 sm:w-48 lg:w-60 xl:w-72 sm:h-56 lg:h-64 rounded-xl" loading="lazy">
                    <img src="{{ $about->image_2 ? Storage::url('about/' . $about->image_2) : asset('images/sebastian-coman-photography-eBmyH7oO5wY-unsplash.webp') }}"
                        alt="Gambar 2 - Tasty Food"
                        class="object-cover w-full h-48 sm:w-48 lg:w-60 xl:w-72 sm:h-56 lg:h-64 rounded-xl" loading="lazy">
                </div>
            </div>
        </section>

        <!-- Section: Visi & Misi -->
        <section class="w-full py-10 space-y-12 bg-white sm:py-15 lg:py-20 sm:space-y-16 lg:space-y-20">
            <!-- Visi -->
            <div class="grid items-center grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-10">
                <!-- Gambar Visi (kiri) -->
                <div
                    class="flex flex-col justify-center order-2 gap-4 transition duration-300 transform sm:flex-row sm:gap-5 lg:order-1 hover:scale-105">
                    <img src="{{ $about->image_1 ? Storage::url('about/' . $about->image_1) : asset('images/fathul-abrar-T-qI_MI2EMA-unsplash.webp') }}"
                        alt="Gambar Visi - Tasty Food"
                        class="object-cover w-full h-48 shadow-md sm:w-48 lg:w-60 xl:w-72 sm:h-56 lg:h-64 rounded-xl"
                        loading="lazy">
                    <img src="{{ $about->image_2 ? Storage::url('about/' . $about->image_2) : asset('images/michele-blackwell-rAyCBQTH7ws-unsplash.webp') }}"
                        alt="Gambar Visi Tambahan - Tasty Food"
                        class="object-cover w-full h-48 shadow-md sm:w-48 lg:w-60 xl:w-72 sm:h-56 lg:h-64 rounded-xl"
                        loading="lazy">
                </div>

                <!-- Teks Visi (kanan) -->
                <div class="order-1 space-y-4 sm:space-y-5 lg:order-2">
                    <h2 class="text-xl font-bold text-black sm:text-2xl">VISI</h2>
                    <p class="text-xs leading-relaxed text-black sm:text-sm">
                        {!! nl2br(e($about->vision ?? 'Visi belum diisi.')) !!}
                    </p>
                </div>
            </div>

            <!-- Misi -->
            <div class="grid items-center grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-15">
                <!-- Teks Misi (kiri) -->
                <div class="order-2 space-y-4 lg:order-1">
                    <h2 class="text-xl font-bold text-black sm:text-2xl">MISI</h2>
                    <p class="text-xs leading-relaxed text-black sm:text-sm">
                        {!! nl2br(e($about->mission ?? 'Misi belum diisi.')) !!}
                    </p>
                </div>

                <!-- Gambar Misi (kanan) -->
                <div class="flex justify-center order-1 transition duration-300 transform lg:order-2 hover:scale-105">
                    <img src="{{ $about->image_2 ? Storage::url('about/' . $about->image_2) : asset('images/sanket-shah-SVA7TyHxojY-unsplash.webp') }}"
                        alt="Gambar Misi - Tasty Food"
                        class="object-cover w-full h-48 max-w-sm shadow-md sm:max-w-md lg:max-w-lg xl:max-w-2xl sm:h-56 lg:h-64 xl:h-72 rounded-xl"
                        loading="lazy">
                </div>
            </div>
        </section>
    </main>
    
@endsection
