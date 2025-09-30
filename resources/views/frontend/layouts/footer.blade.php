<footer class="py-8 px-4 lg:px-16 text-white bg-black sm:py-10">
    <div class="grid grid-cols-1 gap-6 mx-auto max-w-7xl sm:grid-cols-2 md:grid-cols-4 sm:gap-8">
        <!-- Kolom 1: Tasty Food -->
        <div class="md:col-span-1">
            <h2 class="text-base font-bold sm:text-lg">Tasty Food</h2>
            <p class="mt-4 text-xs leading-relaxed text-gray-400 sm:text-sm">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </p>
            <div class="flex gap-3 mt-4">
                <a href="#" class="flex items-center justify-center w-8 h-8 bg-blue-600 rounded-full transition hover:bg-blue-500">
                    <img src="{{ asset('images/001-facebook.webp') }}" alt="Facebook" class="w-4 h-4">
                </a>
                <a href="#" class="flex items-center justify-center w-8 h-8 bg-sky-500 rounded-full transition hover:bg-sky-400">
                    <img src="{{ asset('images/002-twitter.webp') }}" alt="Twitter" class="w-4 h-4">
                </a>
            </div>
        </div>

        <!-- Kolom 2: Useful Links -->
        <div class="md:col-span-1">
            <h3 class="text-base font-bold sm:text-lg">Useful links</h3>
            <ul class="mt-4 space-y-2 text-xs text-gray-400 sm:text-sm">
                <li><a href="#" class="hover:text-white">Blog</a></li>
                <li><a href="#" class="hover:text-white">Hewan</a></li>
                <li><a href="#" class="hover:text-white">Galeri</a></li>
                <li><a href="#" class="hover:text-white">Testimonial</a></li>
            </ul>
        </div>

        <!-- Kolom 3: Privacy -->
        <div class="md:col-span-1">
            <h3 class="text-base font-bold sm:text-lg">Privacy</h3>
            <ul class="mt-4 space-y-2 text-xs text-gray-400 sm:text-sm">
                <li><a href="#" class="hover:text-white">Karir</a></li>
                <li><a href="#" class="hover:text-white">Tentang Kami</a></li>
                <li><a href="#" class="hover:text-white">Kontak Kami</a></li>
                <li><a href="#" class="hover:text-white">Servis</a></li>
            </ul>
        </div>

        <!-- Kolom 4: Contact Info -->
        <div class="md:col-span-1">
            <h3 class="text-base font-bold sm:text-lg">Contact Info</h3>
            <ul class="mt-4 space-y-2 text-xs text-gray-400 sm:text-sm">
                <li class="flex items-center gap-2">
                    <img src="{{ asset('images/ic_markunread_24px.webp') }}" alt="Email" class="w-4 h-4">
                    <span>tastyfood@gmail.com</span>
                </li>
                <li class="flex items-center gap-2">
                    <img src="{{ asset('images/ic_call_24px.webp') }}" alt="Phone" class="w-4 h-4">
                    +62 812 3456 7890
                </li>
                <li class="flex items-center gap-2">
                    <img src="{{ asset('images/ic_place_24px.webp') }}" alt="Location" class="w-4 h-4">
                    Kota Bandung, Jawa Barat
                </li>
            </ul>
        </div>
    </div>

    <!-- Copyright -->
    <div class="pt-4 mt-6 text-xs text-center text-gray-500 border-t border-gray-800 sm:mt-8 sm:text-sm">
        Copyright ©2023 All rights reserved
    </div>
</footer>