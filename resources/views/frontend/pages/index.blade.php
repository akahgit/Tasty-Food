@extends('frontend.layouts.homeNavbar.homeBar')
@section('title', 'Home page')
@section('content')
    {{-- Tentang section --}}
    <section class="flex items-center justify-center w-full h-56 px-4 sm:h-64 lg:h-72">
        <div class="max-w-sm space-y-2 text-center sm:space-y-3 sm:max-w-2xl lg:max-w-3xl">
            <h1 class="text-xl font-bold text-black sm:text-2xl lg:text-3xl xl:text-4xl poppins">TENTANG KAMI</h1>
            <p class="text-xs sm:text-sm lg:text-base max-w-xs sm:max-w-lg lg:max-w-[600px] mx-auto leading-relaxed">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Adipisci delectus, repellat vero recusandae
                dolore mollitia exercitationem vitae eligendi, minima, possimus temporibus. Sed maiores molestias quasi
                repellat amet quae rem qui.
            </p>
            <div class="w-16 mx-auto mt-3 border-black border-1 sm:w-20 sm:mt-5"></div>
        </div>
    </section>
    {{-- Makanan section --}}
    <section class="flex items-center justify-center min-h-screen px-4 py-12 bg-hero sm:px-6 md:px-12 lg:px-20 sm:py-16 lg:py-20">
        <div class="grid grid-cols-1 gap-6 mx-auto sm:grid-cols-2 md:gap-8 lg:grid-cols-4 lg:gap-6 max-w-7xl">
            <div
                class="transform relative w-full max-w-[260px] h-[260px] sm:max-w-[280px] sm:h-[280px] md:max-w-[300px] md:h-[300px] bg-gray-100 rounded-xl p-4 sm:p-5 flex flex-col items-center text-center pt-[90px] sm:pt-[100px] md:pt-[120px] mx-auto transition duration-300 hover:scale-105 shadow-lg">
                <img src="{{ asset('images/img-1.webp') }}" alt="blank"
                    class="absolute -top-[45px] sm:-top-[50px] md:-top-[60px] lg:-top-[100px] w-[100px] sm:w-[120px] md:w-[140px] lg:w-[200px] h-auto object-contain"
                    loading="lazy">
                <h1 class="mb-1 text-sm font-bold sm:text-base lg:text-lg sm:mb-2">LOREM IPSUM</h1>
                <p class="text-xs leading-relaxed sm:text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Culpa cumque excepturi suscipit.
                </p>
            </div>
            <!-- Card 2 -->
            <div
                class="transform relative w-full max-w-[260px] h-[260px] sm:max-w-[280px] sm:h-[280px] md:max-w-[300px] md:h-[300px] bg-gray-100 rounded-xl p-4 sm:p-5 flex flex-col items-center text-center pt-[90px] sm:pt-[100px] md:pt-[120px] mx-auto transition duration-300 hover:scale-105 shadow-lg">
                <img src="{{ asset('images/img-2.webp') }}"
                    class="absolute -top-[45px] sm:-top-[50px] md:-top-[60px] lg:-top-[100px] w-[100px] sm:w-[120px] md:w-[140px] lg:w-[200px] h-auto object-contain"
                    alt="blank" loading="lazy">
                <h1 class="mb-1 text-sm font-bold sm:text-base lg:text-lg sm:mb-2">LOREM IPSUM</h1>
                <p class="text-xs leading-relaxed sm:text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Culpa cumque excepturi suscipit.
                </p>
            </div>
            <!-- Card 3 -->
            <div
                class="transform relative w-full max-w-[260px] h-[260px] sm:max-w-[280px] sm:h-[280px] md:max-w-[300px] md:h-[300px] bg-gray-100 rounded-xl p-4 sm:p-5 flex flex-col items-center text-center pt-[90px] sm:pt-[100px] md:pt-[120px] mx-auto transition duration-300 hover:scale-105 shadow-lg">
                <img src="{{ asset('images/img-3.webp') }}"
                    class="absolute -top-[45px] sm:-top-[50px] md:-top-[60px] lg:-top-[100px] w-[100px] sm:w-[120px] md:w-[140px] lg:w-[200px] h-auto object-contain"
                    alt="blank" loading="lazy">
                <h1 class="mb-1 text-sm font-bold sm:text-base lg:text-lg sm:mb-2">LOREM IPSUM</h1>
                <p class="text-xs leading-relaxed sm:text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Culpa cumque excepturi suscipit.
                </p>
            </div>
            <!-- Card 4 -->
            <div
                class="transform relative w-full max-w-[260px] h-[260px] sm:max-w-[280px] sm:h-[280px] md:max-w-[300px] md:h-[300px] bg-gray-100 shadow-lg rounded-xl p-4 sm:p-5 flex flex-col items-center text-center pt-[90px] sm:pt-[100px] md:pt-[120px] mx-auto transition duration-300 hover:scale-105">
                <img src="{{ asset('images/img-4.webp') }}"
                    class="absolute -top-[45px] sm:-top-[50px] md:-top-[60px] lg:-top-[100px] w-[100px] sm:w-[120px] md:w-[140px] lg:w-[200px] h-auto object-contain"
                    alt="blank" loading="lazy">
                <h1 class="mb-1 text-sm font-bold sm:text-base lg:text-lg sm:mb-2">LOREM IPSUM</h1>
                <p class="text-xs leading-relaxed sm:text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Culpa cumque excepturi suscipit.
                </p>
            </div>
        </div>
    </section>
    {{-- Berita section --}}
    <section class="px-4 py-8 mx-auto sm:px-6 md:px-12 max-w-7xl sm:py-12 lg:py-20">
        <h1 class="mb-6 text-xl font-bold text-center sm:text-2xl lg:text-3xl xl:text-4xl sm:mb-8">BERITA KAMI</h1>
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 sm:gap-6">
            <!-- Card besar -->
            <div class="flex flex-col overflow-hidden bg-white shadow sm:col-span-2 lg:col-span-2 lg:row-span-2 rounded-xl">
                <div class="h-48 sm:h-56 md:h-64 lg:h-60 xl:h-72">
                    <img src="{{ asset('images/fathul-abrar-T-qI_MI2EMA-unsplash.webp') }}" alt="blank"
                        class="object-cover object-center w-full h-full" loading="lazy">
                </div>
                <div class="flex flex-col flex-1 p-3 sm:p-4 lg:p-5">
                    <h3 class="mb-2 text-sm font-bold sm:text-base lg:text-lg">LOREM IPSUM DOLOR SIT AWET, CONSECTUR
                        ADIPISING ELIT
                    </h3>
                    <p class="flex-1 text-xs leading-relaxed text-gray-600 sm:text-sm">Lorem ipsum dolor, sit amet
                        consectetur adipisicing elit. Numquam consequatur commodi perferendis quasi fugit hic veniam
                        ducimus aliquid nostrum...
                    </p>
                    <div class="flex items-center justify-between mt-3 text-xs font-semibold sm:mt-4 sm:text-sm">
                        <a href="#" class="text-yellow-400 cursor-pointer">Baca selengkapnya</a>
                        <span class="text-gray-400 cursor-pointer">...</span>
                    </div>
                </div>
            </div>
            <!-- Card kecil 1 -->
            <div class="flex flex-col overflow-hidden bg-white shadow rounded-xl">
                <div class="h-32 sm:h-40 md:h-44 lg:h-36">
                    <img src="{{ asset('images/sanket-shah-SVA7TyHxojY-unsplash.webp') }}" alt="blank"
                        class="object-cover object-center w-full h-full" loading="lazy">
                </div>
                <div class="flex flex-col flex-1 p-3 sm:p-4">
                    <h3 class="mb-1 text-xs font-bold sm:text-sm lg:text-base sm:mb-2">LOREM IPSUM</h3>
                    <p class="flex-1 text-xs leading-relaxed text-gray-600 sm:text-sm">Lorem ipsum, dolor sit amet
                        consectetur adipisicing elit. Id, perferendis.
                    </p>
                    <div class="flex items-center justify-between mt-3 text-xs font-semibold sm:mt-4 sm:text-sm">
                        <a href="#" class="text-yellow-400 cursor-pointer">Baca selengkapnya</a>
                        <span class="text-gray-400 cursor-pointer">...</span>
                    </div>
                </div>
            </div>
            <!-- Card kecil 2 -->
            <div class="flex flex-col overflow-hidden bg-white shadow rounded-xl">
                <div class="h-32 sm:h-40 md:h-44 lg:h-36">
                    <img src="{{ asset('images/sebastian-coman-photography-eBmyH7oO5wY-unsplash.webp') }}" alt="blank"
                        class="object-cover object-center w-full h-full" loading="lazy">
                </div>
                <div class="flex flex-col flex-1 p-3 sm:p-4">
                    <h3 class="mb-1 text-xs font-bold sm:text-sm lg:text-base sm:mb-2">LOREM IPSUM</h3>
                    <p class="flex-1 text-xs leading-relaxed text-gray-600 sm:text-sm">Lorem ipsum, dolor sit amet
                        consectetur adipisicing elit. Id, perferendis.
                    </p>
                    <div class="flex items-center justify-between mt-3 text-xs font-semibold sm:mt-4 sm:text-sm">
                        <a href="#" class="text-yellow-400 cursor-pointer">Baca selengkapnya</a>
                        <span class="text-gray-400 cursor-pointer">...</span>
                    </div>
                </div>
            </div>
            <!-- Card kecil 3 -->
            <div class="flex flex-col overflow-hidden bg-white shadow sm:col-start-1 lg:col-start-3 rounded-xl">
                <div class="h-32 sm:h-40 md:h-44 lg:h-36">
                    <img src="{{ asset('images/jimmy-dean-Jvw3pxgeiZw-unsplash.webp') }}" alt="blank"
                        class="object-cover object-center w-full h-full" loading="lazy">
                </div>
                <div class="flex flex-col flex-1 p-3 sm:p-4">
                    <h3 class="mb-1 text-xs font-bold sm:text-sm lg:text-base sm:mb-2">LOREM IPSUM</h3>
                    <p class="flex-1 text-xs leading-relaxed text-gray-600 sm:text-sm">Lorem ipsum, dolor sit amet
                        consectetur adipisicing elit. Id, perferendis.
                    </p>
                    <div class="flex items-center justify-between mt-3 text-xs font-semibold sm:mt-4 sm:text-sm">
                        <a href="#" class="text-yellow-400 cursor-pointer">Baca selengkapnya</a>
                        <span class="text-gray-400 cursor-pointer">...</span>
                    </div>
                </div>
            </div>
            <!-- Card kecil 4 -->
            <div class="flex flex-col overflow-hidden bg-white shadow sm:col-start-2 lg:col-start-4 rounded-xl">
                <div class="h-32 sm:h-40 md:h-44 lg:h-36">
                    <img src="{{ asset('images/luisa-brimble-HvXEbkcXjSk-unsplash.webp') }}" alt="blank"
                        class="object-cover object-center w-full h-full" loading="lazy">
                </div>
                <div class="flex flex-col flex-1 p-3 sm:p-4">
                    <h3 class="mb-1 text-xs font-bold sm:text-sm lg:text-base sm:mb-2">LOREM IPSUM</h3>
                    <p class="flex-1 text-xs leading-relaxed text-gray-600 sm:text-sm">Lorem ipsum, dolor sit amet
                        consectetur adipisicing elit. Id, perferendis.
                    </p>
                    <div class="flex items-center justify-between mt-3 text-xs font-semibold sm:mt-4 sm:text-sm">
                        <a href="#" class="text-yellow-400 cursor-pointer">Baca selengkapnya</a>
                        <span class="text-gray-400 cursor-pointer">...</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Galery section --}}
    <section class="py-8 bg-white sm:py-12 lg:py-16">
        <div class="container px-4 mx-auto text-center sm:px-6 md:px-12 max-w-7xl">
            <h2 class="mb-4 text-xl font-semibold sm:text-2xl lg:text-3xl xl:text-4xl sm:mb-6 lg:mb-10">GALERI KAMI</h2>
            <div class="grid grid-cols-1 gap-3 mb-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 sm:gap-4 md:gap-6 lg:gap-6 sm:mb-6 lg:mb-10">
                <!-- Card 1 -->
                <div class="overflow-hidden rounded-xl">
                    <div class="h-48 sm:h-56 md:h-64 lg:h-64">
                        <img src="{{ asset('images/brooke-lark-oaz0raysASk-unsplash.webp') }}" alt="blank"
                            class="object-cover object-center w-full h-full transition duration-500 transform hover:scale-105 hover:shadow-2xl"
                            loading="lazy">
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="overflow-hidden rounded-xl">
                    <div class="h-48 sm:h-56 md:h-64 lg:h-64">
                        <img src="{{ asset('images/anh-nguyen-kcA-c3f_3FE-unsplash.webp') }}" alt="blank"
                            class="object-cover object-center w-full h-full transition duration-500 transform hover:scale-105 hover:shadow-2xl"
                            loading="lazy">
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="overflow-hidden rounded-xl">
                    <div class="h-48 sm:h-56 md:h-64 lg:h-64">
                        <img src="{{ asset('images/anna-pelzer-IGfIGP5ONV0-unsplash.webp') }}" alt="blank"
                            class="object-cover object-center w-full h-full transition duration-500 transform hover:scale-105 hover:shadow-2xl"
                            loading="lazy">
                    </div>
                </div>
                <!-- Card 4 -->
                <div class="overflow-hidden rounded-xl">
                    <div class="h-48 sm:h-56 md:h-64 lg:h-64">
                        <img src="{{ asset('images/brooke-lark-oaz0raysASk-unsplash.webp') }}" alt="blank"
                            class="object-cover object-center w-full h-full transition duration-500 transform hover:scale-105 hover:shadow-2xl"
                            loading="lazy">
                    </div>
                </div>
                <!-- Card 5 -->
                <div class="overflow-hidden rounded-xl">
                    <div class="h-48 sm:h-56 md:h-64 lg:h-64">
                        <img src="{{ asset('images/eiliv-aceron-ZuIDLSz3XLg-unsplash.webp') }}" alt="blank"
                            class="object-cover object-center w-full h-full transition duration-500 transform hover:scale-105 hover:shadow-2xl"
                            loading="lazy">
                    </div>
                </div>
                <!-- Card 6 -->
                <div class="overflow-hidden rounded-xl">
                    <div class="h-48 sm:h-56 md:h-64 lg:h-64">
                        <img src="{{ asset('images/brooke-lark-nBtmglfY0HU-unsplash.webp') }}" alt="blank"
                            class="object-cover object-center w-full h-full transition duration-500 transform hover:scale-105 hover:shadow-2xl"
                            loading="lazy">
                    </div>
                </div>
            </div>
            <a href="{{ route('frontend.galery') }}" class="px-12 py-2 text-xs text-white transition bg-black rounded-lg cursor-pointer sm:px-16 lg:px-20 sm:py-3 hover:bg-gray-800 sm:text-sm lg:text-base">
                LIHAT LEBIH BANYAK
            </a>
        </div>
    </section>
@endsection