<section class="relative w-full h-screen overflow-hidden bg-gray-100">
    <header
        class="absolute top-0 left-0 z-20 flex flex-col w-full gap-2 px-4 py-6 sm:flex-row sm:items-center sm:gap-4 lg:gap-10 sm:px-6 lg:px-20 sm:py-4 lg:py-16">
        <div class="flex items-center justify-between w-full sm:w-auto">
            <h1 class="text-lg font-bold sm:text-xl lg:text-2xl">TASTY FOOD</h1>
            <button id="menu-toggle" class="p-2 text-black transition-colors rounded-md sm:hidden hover:bg-black/10 focus:outline-none focus:ring-2 focus:ring-black/20">
                <i class="text-xl fa-solid fa-bars"></i>
            </button>
        </div>

        <nav id="navbar-menu"
            class="fixed top-0 right-0 z-30 flex-col justify-start hidden h-screen gap-6 px-6 py-8 text-base shadow-lg w-80 bg-white/70 backdrop-blur-sm sm:relative sm:flex sm:flex-row sm:items-center sm:gap-4 lg:gap-6 sm:text-sm lg:text-base sm:w-auto sm:bg-transparent sm:h-auto sm:p-0 sm:shadow-none sm:inset-auto sm:backdrop-blur-none">
            
            <!-- Mobile button -->
            <div class="flex items-center justify-between w-full pb-6 border-b border-gray-300/40 sm:hidden">
                <h2 class="text-xl font-bold">TASTY FOOD</h2>
                <button id="menu-close" class="p-2 text-black transition-colors rounded-md hover:bg-black/10 focus:outline-none focus:ring-2 focus:ring-black/20">
                    <i class="text-xl fa-solid fa-times"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:gap-4 lg:gap-6">
                <a href="{{ route('frontend.index') }}" class="px-4 py-3 font-sans text-black transition border-b border-transparent rounded-lg sm:py-0 sm:px-0 hover:text-black/70 hover:border-black/30 hover:bg-gray-100 sm:hover:border-transparent sm:hover:bg-transparent sm:rounded-none">HOME</a>
                <a href="{{ route('frontend.tentang') }}" class="px-4 py-3 font-sans text-black transition border-b border-transparent rounded-lg sm:py-0 sm:px-0 hover:text-black/70 hover:border-black/30 hover:bg-gray-100 sm:hover:border-transparent sm:hover:bg-transparent sm:rounded-none">TENTANG</a>
                <a href="{{ route('frontend.berita') }}" class="px-4 py-3 font-sans text-black transition border-b border-transparent rounded-lg sm:py-0 sm:px-0 hover:text-black/70 hover:border-black/30 hover:bg-gray-100 sm:hover:border-transparent sm:hover:bg-transparent sm:rounded-none">BERITA</a>
                <a href="{{ route('frontend.galery') }}" class="px-4 py-3 font-sans text-black transition border-b border-transparent rounded-lg sm:py-0 sm:px-0 hover:text-black/70 hover:border-black/30 hover:bg-gray-100 sm:hover:border-transparent sm:hover:bg-transparent sm:rounded-none">GALERY</a>
                <a href="{{ route('kontak.create') }}" class="px-4 py-3 font-sans text-black transition border-b border-transparent rounded-lg sm:py-0 sm:px-0 hover:text-black/70 hover:border-black/30 hover:bg-gray-100 sm:hover:border-transparent sm:hover:bg-transparent sm:rounded-none">KONTAK</a>
            </div>

            <!-- Auth Buttons -->
            <div class="flex flex-col gap-4 pt-6 mt-6 border-t border-gray-300/40 sm:flex-row sm:gap-2 sm:ml-auto sm:pt-0 sm:mt-0 sm:border-t-0">
                @guest
                    <!-- Tampilkan Login & Register -->
                    <a href="{{ route('login') }}"
                        class="w-full px-6 py-3 font-semibold text-center text-white transition bg-purple-600 rounded-lg hover:bg-purple-700 sm:w-auto sm:py-2">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="w-full px-6 py-3 font-semibold text-center text-white transition bg-yellow-400 rounded-lg hover:bg-yellow-500 sm:w-auto sm:py-2">
                        Register
                    </a>
                @else
                    <!-- user sudah login -->
                    @if (auth()->user()->role === 'admin')
                        <!-- Admin: Tombol Dashboard -->
                        <a href="{{ route('admin.dashboard') }}"
                            class="w-full px-6 py-3 font-semibold text-center text-white transition bg-purple-600 rounded-lg hover:bg-purple-700 sm:w-auto sm:py-2">
                            Dashboard
                        </a>
                    @else
                        <!-- Tombol Logout untuk user -->
                        <form method="POST" action="{{ route('logout') }}"
                            class="w-full sm:w-auto">
                            @csrf
                            <button type="submit" class="w-full px-6 py-3 font-semibold text-center text-white transition bg-red-600 rounded-lg hover:bg-red-700 sm:w-auto sm:py-2">Logout</button>
                        </form>
                    @endif
                @endguest
            </div>
        </nav>
    </header>

    <div
        class="relative z-10 flex flex-col items-center w-full h-full px-4 pt-20 lg:flex-row sm:px-6 lg:px-20 sm:pt-24 lg:pt-0">
        <div class="space-y-3 text-center lg:w-1/2 sm:space-y-4 lg:text-left">
            <div class="w-16 mx-auto mt-8 border-black border-1 sm:w-20 sm:mt-12 lg:mt-20 lg:mx-0"></div>
            <h1 class="mt-6 text-2xl font-normal text-black sm:text-3xl lg:text-4xl xl:text-5xl sm:mt-8 lg:mt-10">
                HEALTHY</h1>
            <span class="block text-2xl font-extrabold text-black sm:text-3xl lg:text-4xl xl:text-5xl">TASTY
                FOOD</span>
            <p class="max-w-xs mx-auto text-xs leading-relaxed text-black sm:text-sm lg:text-base sm:max-w-md lg:mx-0">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Minima sunt nostrum quod reprehenderit ex
                porro voluptate? Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias impedit ab, illo
                distinctio praesentium sit quas, adipisci neque veritatis quibusdam amet quaerat nam aliquid
                necessitatibus dolorum veniam reiciendis, eaque illum.
            </p>
            <a href="{{ route('frontend.tentang') }}"
                class="inline-block px-6 py-2 text-xs text-white bg-black rounded hover:bg-gray-800 sm:px-12 lg:px-16 xl:px-20 sm:text-sm lg:text-base">
                TENTANG KAMI
            </a>
        </div>
    </div>

    <!-- Fixed Image Positioning for Mobile and Tablet -->
    <div
        class="absolute bottom-20 right-0 w-full h-[200px] flex justify-center sm:bottom-16 sm:top-auto sm:right-4 sm:w-[280px] sm:h-[280px] md:bottom-96 md:right-60  md:w-[320px] md:h-96 lg:w-[500px] lg:h-[500px] xl:w-[800px] xl:h-[800px] lg:justify-end lg:-right-52 lg:bottom-10">
        <img src="{{ asset('images/img-4-2000x2000.webp') }}" alt=""
            class="w-[180px] h-[180px] sm:w-[280px] sm:h-[280px] md:w-[320px] md:h-[320px] lg:w-[500px] lg:h-[500px] xl:w-[800px] xl:h-[800px] object-cover object-center" />
    </div>

    <div id="menu-overlay" class="fixed inset-0 z-10 hidden bg-black/50 sm:hidden"></div>
</section>