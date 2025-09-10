    @extends('frontend.layouts.innerNavbar.navbar')

    @section('title', 'Kontak Kami')
    @section('hero-bg', 'bg-hero-tentang')
    @section('hero-title', 'KONTAK KAMI')

    @section('content')
        <main class="container min-h-screen mx-auto">
            <section class="w-full min-h-screen px-4 py-8 bg-white sm:px-5 lg:px-20 sm:py-12 lg:py-16">
                <h2 class="mb-6 text-xl font-bold text-black sm:text-2xl sm:mb-8">KIRIM PESAN</h2>

                @if (session('success'))
                    <div class="p-4 mb-6 text-green-700 bg-green-100 border border-green-200 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('kontak.store') }}" method="POST"
                    class="grid grid-cols-1 gap-4 mb-8 md:grid-cols-2 sm:mb-10">
                    @csrf

                    <div class="flex flex-col gap-4">
                        <!-- Subject -->
                        <div>
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" id="subject" name="subject" placeholder="Subject"
                                value="{{ old('subject') }}"
                                class="w-full px-4 py-3 text-sm border border-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-black sm:text-base">
                            @error('subject')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Name -->
                        <div>
                            <label for="name" class="sr-only">Nama</label>
                            <input type="text" id="name" name="name" placeholder="Name" value="{{ old('name') }}"
                                required
                                class="w-full px-4 py-3 text-sm border border-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-black sm:text-base">
                            @error('name')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}"
                                required
                                class="w-full px-4 py-3 text-sm border border-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-black sm:text-base">
                            @error('email')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Message -->
                    <div>
                        <label for="message" class="sr-only">Pesan</label>
                        <textarea id="message" name="message" placeholder="Message" required
                            class="w-full border border-gray-900 px-4 py-3 rounded-md h-full min-h-[180px] focus:outline-none focus:ring-2 focus:ring-black text-sm sm:text-base">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="col-span-1 md:col-span-2">
                        <button type="submit"
                            class="w-full py-3 text-sm font-semibold text-white transition duration-300 bg-black rounded-md hover:bg-gray-800 sm:text-base">
                            KIRIM PESAN
                        </button>
                    </div>
                </form>

                <!-- Kontak Info -->
                <div class="grid grid-cols-1 gap-6 text-center sm:grid-cols-3 sm:gap-8">
                    <div class="flex flex-col items-center gap-2">
                        <div class="flex items-center justify-center w-12 h-12 text-xl text-white bg-black rounded-full">
                            <img src="{{ asset('images/ic_markunread_24px@2x.webp') }}" alt="Email" class="w-6 h-4">
                        </div>
                        <p class="mt-2 text-sm font-bold">EMAIL</p>
                        <p class="text-sm break-all">tastyfood@gmail.com</p>
                    </div>

                    <div class="flex flex-col items-center gap-2">
                        <div class="flex items-center justify-center w-12 h-12 text-xl text-white bg-black rounded-full">
                            <img src="{{ asset('images/ic_call_24px@2x.webp') }}" alt="Phone" class="w-6 h-5">
                        </div>
                        <p class="mt-2 text-sm font-bold">PHONE</p>
                        <p class="text-sm">+62 812 3456 7890</p>
                    </div>

                    <div class="flex flex-col items-center gap-2">
                        <div class="flex items-center justify-center w-12 h-12 text-xl text-white bg-black rounded-full">
                            <img src="{{ asset('images/ic_place_24px@2x.webp') }}" alt="Location" class="w-3 h-4">
                        </div>
                        <p class="mt-2 text-sm font-bold">LOCATION</p>
                        <p class="text-sm">Kota Bandung, Jawa Barat</p>
                    </div>
                </div>
            </section>
        </main>

        <!-- Google Maps -->
        <section
            class="flex items-center justify-center w-full min-h-screen px-4 py-10 bg-gray-200 sm:py-15 lg:py-20 sm:px-10 lg:px-20">
            <div class="w-full h-[300px] sm:h-[350px] lg:h-[400px] rounded-xl overflow-hidden shadow-md">
                @if ($map)
                    <iframe src="{{ $map->embed_url }}" width="100%" height="100%" style="border:0;" allowfullscreen
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="{{ $map->title }}">
                    </iframe>
                @else
                    <p class="text-center text-gray-600">Lokasi belum diset.</p>
                @endif
            </div>
        </section>
    @endsection
