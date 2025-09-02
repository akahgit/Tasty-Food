<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('resource/costum.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @vite('resources/css/app.css')
    <title>@yield('title', 'Tasty Food')</title>
</head>

<body>
    {{-- Navbar --}}
    @include('frontend.layouts.innerNavbar.mainNav')

    {{-- Hero Section Dinamis --}}
    <section class="relative h-screen @yield('hero-bg') overflow-hidden">
        <div class="absolute inset-0 bg-opacity-50"></div>
        <div class="relative z-10 flex items-center h-full px-4 sm:px-6 lg:px-10">
            <h1 class="text-3xl font-extrabold text-white sm:text-3xl lg:text-6xl">
                @yield('hero-title')
            </h1>
        </div>
    </section>

    {{-- Content --}}
    <main>
        @yield('content')
    </main>

    @include('frontend.layouts.footer')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const menuClose = document.getElementById('menu-close');
            const navbarMenu = document.getElementById('navbar-menu');
            const menuOverlay = document.getElementById('menu-overlay');

            function openMenu() {
                navbarMenu.classList.remove('hidden');
                navbarMenu.classList.add('flex');
                menuOverlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeMenu() {
                navbarMenu.classList.add('hidden');
                navbarMenu.classList.remove('flex');
                menuOverlay.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            menuToggle.addEventListener('click', openMenu);
            menuClose.addEventListener('click', closeMenu);
            menuOverlay.addEventListener('click', closeMenu);

            // Close menu when clicking on navigation links (mobile)
            const navLinks = navbarMenu.querySelectorAll('a');
            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 640) {
                        closeMenu();
                    }
                });
            });
        });
    </script>
</body>

</html>
