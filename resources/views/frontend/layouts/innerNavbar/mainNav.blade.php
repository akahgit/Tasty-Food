<header class="absolute top-0 left-0 z-20 w-full px-3 lg:px-10 py-16 text-white bg-tansparent">
    <div class="flex items-center justify-between w-full px-6 py-4">
        <!-- Logo + toggle -->
        <div class="flex items-center justify-between w-full sm:w-auto">
            <div class="text-xl font-bold sm:text-2xl">TASTY FOOD</div>
            <button id="menu-toggle" class="p-2 text-white transition-colors rounded-md sm:hidden hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/20">
                <i class="text-xl fa-solid fa-bars"></i>
            </button>
        </div>

        <!-- Desktop Menu -->
        <nav class="hidden sm:flex sm:items-center sm:space-x-6 sm:ml-auto">
            <ul class="flex flex-col items-center gap-4 mt-4 text-sm sm:mt-0 sm:flex-row sm:gap-6">
                <li><a href="{{ route('frontend.index') }}" class="px-2 py-2 hover:text-gray-300">HOME</a></li>
                <li><a href="{{ route('frontend.tentang') }}" class="px-2 py-2 hover:text-gray-300">TENTANG</a></li>
                <li><a href="{{ route('frontend.berita') }}" class="px-2 py-2 hover:text-gray-300">BERITA</a></li>
                <li><a href="{{ route('frontend.galery') }}" class="px-2 py-2 hover:text-gray-300">GALERI</a></li>
                <li><a href="{{ route('kontak.create') }}" class="px-2 py-2 hover:text-gray-300">KONTAK</a></li>
            </ul>

            <!-- Auth buttons -->
            <div class="flex items-center gap-2 ml-0 sm:ml-6">
                @guest
                    <a href="{{ route('login') }}" class="px-4 py-2 text-white transition bg-gray-600 rounded hover:bg-gray-700">Login</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 text-white transition bg-blue-600 rounded hover:bg-blue-700">Register</a>
                @else
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-white transition bg-blue-600 rounded hover:bg-blue-700">Dashboard</a>
                    @else
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="px-4 py-2 text-white transition bg-red-600 rounded hover:bg-red-700">Logout</button>
                        </form>
                    @endif
                @endguest
            </div>
        </nav>

        <!-- Mobile Menu with Blur Effect -->
        <nav id="navbar-menu"
            class="fixed top-0 right-0 z-40 flex-col justify-start hidden h-screen gap-6 px-6 py-8 text-base text-white shadow-lg w-80 bg-white/10 backdrop-blur-sm sm:hidden">
            
            <!-- Mobile Header with Close Button -->
            <div class="flex items-center justify-between w-full pb-6 border-b border-white/30">
                <h2 class="text-xl font-bold">TASTY FOOD</h2>
                <button id="menu-close" class="p-2 text-white transition-colors rounded-md hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white/20">
                    <i class="text-xl fa-solid fa-times"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <div class="flex flex-col gap-6">
                <a href="{{ route('frontend.index') }}" class="px-4 py-3 font-sans text-white transition border-b border-transparent rounded-lg hover:text-white/70 hover:border-white/30 hover:bg-white/10">HOME</a>
                <a href="{{ route('frontend.tentang') }}" class="px-4 py-3 font-sans text-white transition border-b border-transparent rounded-lg hover:text-white/70 hover:border-white/30 hover:bg-white/10">TENTANG</a>
                <a href="{{ route('frontend.berita') }}" class="px-4 py-3 font-sans text-white transition border-b border-transparent rounded-lg hover:text-white/70 hover:border-white/30 hover:bg-white/10">BERITA</a>
                <a href="{{ route('frontend.galery') }}" class="px-4 py-3 font-sans text-white transition border-b border-transparent rounded-lg hover:text-white/70 hover:border-white/30 hover:bg-white/10">GALERI</a>
                <a href="{{ route('kontak.create') }}" class="px-4 py-3 font-sans text-white transition border-b border-transparent rounded-lg hover:text-white/70 hover:border-white/30 hover:bg-white/10">KONTAK</a>
            </div>

            <!-- Auth Buttons -->
            <div class="flex flex-col gap-4 pt-6 mt-6 border-t border-white/30">
                @guest
                    <a href="{{ route('login') }}" class="w-full px-6 py-3 font-semibold text-center text-white transition rounded-lg bg-gray-600/80 hover:bg-gray-700/80">Login</a>
                    <a href="{{ route('register') }}" class="w-full px-6 py-3 font-semibold text-center text-white transition rounded-lg bg-blue-600/80 hover:bg-blue-700/80">Register</a>
                @else
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="w-full px-6 py-3 font-semibold text-center text-white transition rounded-lg bg-blue-600/80 hover:bg-blue-700/80">Dashboard</a>
                    @else
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="w-full px-6 py-3 font-semibold text-center text-white transition rounded-lg bg-red-600/80 hover:bg-red-700/80">Logout</button>
                        </form>
                    @endif
                @endguest
            </div>
        </nav>
    </div>
    <div id="menu-overlay" class="fixed inset-0 z-10 hidden bg-black/50 sm:hidden"></div>
</header>