@extends('frontend.layouts.innerNavbar.navbar')

@section('title', 'Berita kami')
@section('hero-bg', 'bg-hero-tentang')
@section('hero-title', 'BERITA KAMI')

@section('content')
    <main class="container min-h-screen px-4 mx-auto sm:px-6 lg:px-8">
        <!-- Section: Berita Utama -->
        <section class="relative flex items-center justify-center min-h-screen py-10 lg:py-20">
            @if ($news->isNotEmpty())
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
            @else
                <div class="py-10 text-center">
                    <p class="text-xl text-gray-500">Belum ada berita yang dipublikasikan.</p>
                </div>
            @endif
        </section>

        <!-- Berita Lainnya -->
        <section class="px-4 mx-auto max-w-7xl sm:py-10">
            <h1 class="mb-6 text-2xl font-bold sm:text-2xl md:text-3xl sm:mb-8">BERITA LAINNYA</h1>

            @if ($news->skip(1)->isNotEmpty())
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 sm:gap-6">
                    @foreach ($news->skip(1) as $item)
                        <div
                            class="flex flex-col overflow-hidden transition duration-300 transform bg-white shadow rounded-xl hover:scale-105">
                            <div class="h-32 sm:h-36">
                                <img src="{{ $item->image ? Storage::url('news/' . $item->image) : asset('images/img-1.webp') }}"
                                    alt="{{ $item->title }}" class="object-cover object-center w-full h-full"
                                    loading="lazy">
                            </div>
                            <div class="flex flex-col flex-1 p-4">
                                <h3 class="mb-2 text-sm font-bold sm:text-base">{{ $item->title }}</h3>
                                <p class="flex-1 text-xs text-gray-600 sm:text-sm">
                                    {{ Str::limit(strip_tags($item->content), 100) }}
                                </p>
                                <div class="flex items-center justify-between mt-4 text-xs font-semibold sm:text-sm">
                                    <a href="{{ route('frontend.berita.detail', $item->id) }}" class="text-yellow-400">Baca
                                        selengkapnya</a>
                                    <span class="text-gray-400">...</span>
                                </div>
                            </div>
                        </div>
                    @endforeach 
                </div>
            @else
                <p class="text-center text-gray-500">Tidak ada berita tambahan.</p>
            @endif
        </section>
        <div class="flex justify-end mb-10">
            {{ $news->links() }}
        </div>
    </main>
@endsection
