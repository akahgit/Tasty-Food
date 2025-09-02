@extends('frontend.layouts.innerNavbar.navbar')
@section('title', 'Galeri Kami')
@section('hero-bg', 'bg-hero-tentang')
@section('hero-title', 'GALERI KAMI')

@section('content')
    {{-- Galery section swipper js (TETAP STATIS) --}}
    <main class="container py-6 mx-auto sm:py-8 lg:py-10">
        <section class="flex items-center justify-center w-full px-4 py-6 sm:py-8 lg:py-10">
            <div
                class="swiper mySwiper rounded-xl sm:rounded-2xl shadow-xl overflow-hidden w-full max-w-[350px] sm:max-w-[600px] md:max-w-[800px] lg:max-w-[1000px] xl:max-w-[1200px] h-[200px] sm:h-[300px] md:h-[400px] lg:h-[450px] xl:h-[500px]">
                <div class="swiper-wrapper">
                    <div class="swiper-slide cursor-zoom-in"
                        onclick="openModal('{{ asset('images/ella-olsson-mmnKI8kMxpc-unsplash.webp') }}', 'Deskripsi gambar 1')">
                        <img src="{{ asset('images/ella-olsson-mmnKI8kMxpc-unsplash.webp') }}" alt="Galeri 1"
                            class="object-cover object-center w-full h-full" loading="lazy">
                    </div>
                    <div class="swiper-slide cursor-zoom-in"
                        onclick="openModal('{{ asset('images/anna-pelzer-IGfIGP5ONV0-unsplash.webp') }}', 'Deskripsi gambar 2')">
                        <img src="{{ asset('images/anna-pelzer-IGfIGP5ONV0-unsplash.webp') }}" alt="Galeri 2"
                            class="object-cover object-center w-full h-full" loading="lazy">
                    </div>
                    <div class="swiper-slide cursor-zoom-in"
                        onclick="openModal('{{ asset('images/anh-nguyen-kcA-c3f_3FE-unsplash.webp') }}', 'Deskripsi gambar 3')">
                        <img src="{{ asset('images/anh-nguyen-kcA-c3f_3FE-unsplash.webp') }}" alt="Galeri 3"
                            class="object-cover object-center w-full h-full" loading="lazy">
                    </div>
                </div>

                <div class="swiper-button-prev swiper-button-custom"></div>
                <div class="swiper-button-next swiper-button-custom"></div>
                <div class="swiper-pagination"></div>
            </div>
        </section>
    </main>

    {{-- Galery section (DINAMIS dari database) --}}
    <section class="w-full py-6 bg-white sm:py-10 lg:py-16">
        <div class="container px-10 mx-auto text-center max-w-7xl">
            <div
                class="grid grid-cols-1 gap-3 mb-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 sm:gap-4 lg:gap-6 sm:mb-6 lg:mb-10">
                @if ($images->isNotEmpty())
                    @foreach ($images as $image)
                        <div class="overflow-hidden rounded-lg sm:rounded-xl cursor-zoom-in"
                            onclick="openModal('{{ Storage::url('gallery/' . $image->image) }}', '{{ $image->caption ?? '' }}')">
                            <div class="h-40 bg-gray-200 sm:h-48 md:h-56 lg:h-64">
                                <img src="{{ Storage::url('gallery/' . $image->image) }}"
                                    alt="{{ Str::limit($image->caption ?? 'Galeri Foto', 50) }}"
                                    class="object-cover object-center w-full h-full transition duration-300 transform hover:scale-105 hover:shadow-2xl"
                                    loading="lazy">
                            </div>
                            @if ($image->caption)
                                <p class="px-2 mt-1 text-xs text-gray-600">{{ Str::limit($image->caption, 40) }}</p>
                            @endif
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-500 col-span-full">Belum ada foto di galeri.</p>
                @endif
            </div>
        </div>
    </section>

    <!-- Lightbox Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 bg-black bg-opacity-90">
        <div class="relative max-w-4xl max-h-full">
            <button onclick="closeModal()"
                class="absolute text-4xl text-white -top-10 -right-2 hover:text-gray-300">&times;</button>
            <img id="modalImage" alt="Preview">
            <p id="modalCaption" class="mt-2 text-sm text-center text-white"></p>
        </div>
    </div>
    <div id="modalBackdrop" class="fixed inset-0 z-40 hidden bg-black bg-opacity-50" onclick="closeModal()"></div>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        // Inisialisasi Swiper
        new Swiper(".mySwiper", {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            zoom: true,
        });

        // Modal Zoom Preview
        function openModal(imageSrc, caption) {
            const modal = document.getElementById('imageModal');
            const backdrop = document.getElementById('modalBackdrop');
            const modalImage = document.getElementById('modalImage');
            const modalCaption = document.getElementById('modalCaption');

            modalImage.src = imageSrc;
            modalCaption.textContent = caption || '';
            modal.classList.remove('hidden');
            backdrop.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            const backdrop = document.getElementById('modalBackdrop');

            modal.classList.add('hidden');
            backdrop.classList.add('hidden');
            document.body.style.overflow = '';
        }

        // Close dengan ESC
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });
    </script>

    <style>
        .swiper-button-custom {
            background: white;
            border-radius: 9999px;
            width: 2.5rem;
            height: 2.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.8;
            transition: opacity 0.2s;
        }

        .swiper-button-custom:hover {
            opacity: 1;
        }

        .cursor-zoom-in {
            cursor: zoom-in;
        }

        #modalImage {
            max-width: 95vw;
            max-height: 85vh;
            object-fit: contain;
            border-radius: 0.5rem;
        }
    </style>
@endsection
