<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Admin Dashboard</title>
    @vite('resources/css/app.css')
    <style>
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #3d68ff; }
        .cta-btn { color: #3d68ff; }
        .upgrade-btn { background: #1947ee; }
        .upgrade-btn:hover { background: #0038fd; }
        .active-nav-link { background: #1947ee; }
        .nav-item:hover { background: #1947ee; }
        .account-link:hover { background: #3d68ff; }
    </style>
</head>

<body class="font-sans bg-gray-100">

    <!-- Mobile Header -->
    <header x-data="{ isOpen: false }" class="fixed top-0 z-20 w-full px-6 py-5 bg-sidebar sm:hidden">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.dashboard') }}" class="text-3xl font-semibold text-white uppercase">Admin</a>
            <button @click="isOpen = !isOpen" class="text-white focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Mobile Dropdown Nav -->
        <nav x-show="isOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform -translate-y-4"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-4" class="pt-4 pb-6 bg-sidebar">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center py-2 pl-6 text-white rounded {{ request()->routeIs('admin.dashboard') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} nav-item">
               <i class="mr-3 fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="{{ route('admin.about.edit') }}"
               class="flex items-center py-2 pl-6 text-white rounded {{ request()->routeIs('admin.about.edit') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} nav-item">
               <i class="mr-3 fas fa-sticky-note"></i> Tentang
            </a>
            <a href="{{ route('admin.news.index') }}"
               class="flex items-center py-2 pl-6 text-white rounded {{ request()->routeIs('admin.news.*') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} nav-item">
               <i class="mr-3 fas fa-align-left"></i> Berita
            </a>
            <a href="{{ route('admin.gallery.index') }}"
               class="flex items-center py-2 pl-6 text-white rounded {{ request()->routeIs('admin.gallery.*') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} nav-item">
               <i class="mr-3 fas fa-table"></i> Gallery
            </a>
            <a href="{{ route('admin.contact.index') }}"
               class="flex items-center py-2 pl-6 text-white rounded {{ request()->routeIs('admin.contact.*') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} nav-item">
               <i class="mr-3 fas fa-tablet-alt"></i> Kontak
            </a>
            <a href="{{ route('admin.map.edit') }}"
               class="flex items-center py-2 pl-6 text-white rounded {{ request()->routeIs('admin.map.edit') ? 'active-nav-link' : 'opacity-75 hover:opacity-100' }} nav-item">
               <i class="mr-3 fas fa-map-marked-alt"></i> Edit Maps
            </a>
            <a href="{{ route('frontend.index') }}" target="_blank"
               class="flex items-center py-2 pl-6 text-white opacity-75 hover:opacity-100 nav-item">
               <i class="mr-3 fas fa-external-link-alt"></i> Frontend
            </a>

            <!-- Logout di mobile -->
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit"
                    class="flex items-center w-full py-2 pl-6 text-white opacity-75 hover:opacity-100 nav-item">
                    <i class="mr-3 fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </nav>
    </header>

    <!-- Desktop Sidebar -->
    <aside class="fixed inset-y-0 left-0 z-10 hidden w-64 shadow-xl bg-sidebar sm:block">
        <div class="flex flex-col h-full">
            <!-- Header -->
            <div class="p-6">
                <a href="{{ route('admin.dashboard') }}"
                    class="text-3xl font-semibold text-white uppercase hover:text-gray-300">Admin</a>
            </div>

            <!-- Nav -->
            <nav class="flex-1 px-3 py-4 overflow-y-auto text-base font-semibold text-white">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center py-3 pl-6 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : 'opacity-75 hover:opacity-100' }} nav-item">
                   <i class="mr-3 fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="{{ route('admin.about.edit') }}"
                   class="flex items-center py-3 pl-6 rounded {{ request()->routeIs('admin.about.edit') ? 'bg-blue-700' : 'opacity-75 hover:opacity-100' }} nav-item">
                   <i class="mr-3 fas fa-sticky-note"></i> Tentang
                </a>
                <a href="{{ route('admin.news.index') }}"
                   class="flex items-center py-3 pl-6 rounded {{ request()->routeIs('admin.news.*') ? 'bg-blue-700' : 'opacity-75 hover:opacity-100' }} nav-item">
                   <i class="mr-3 fas fa-align-left"></i> Berita
                </a>
                <a href="{{ route('admin.gallery.index') }}"
                   class="flex items-center py-3 pl-6 rounded {{ request()->routeIs('admin.gallery.*') ? 'bg-blue-700' : 'opacity-75 hover:opacity-100' }} nav-item">
                   <i class="mr-3 fas fa-table"></i> Gallery
                </a>
                <a href="{{ route('admin.contact.index') }}"
                   class="flex items-center py-3 pl-6 rounded {{ request()->routeIs('admin.contact.*') ? 'bg-blue-700' : 'opacity-75 hover:opacity-100' }} nav-item">
                   <i class="mr-3 fas fa-tablet-alt"></i> Kontak
                </a>
                <a href="{{ route('admin.map.edit') }}"
                   class="flex items-center py-3 pl-6 rounded {{ request()->routeIs('admin.map.edit') ? 'bg-blue-700' : 'opacity-75 hover:opacity-100' }} nav-item">
                   <i class="mr-3 fas fa-map-marked-alt"></i> Edit Maps
                </a>
                <a href="{{ route('frontend.index') }}" target="_blank"
                   class="flex items-center py-3 pl-6 rounded opacity-75 hover:opacity-100 nav-item">
                   <i class="mr-3 fas fa-external-link-alt"></i> Frontend
                </a>
            </nav>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}" class="p-3 border-t border-blue-500">
                @csrf
                <button type="submit"
                    class="flex items-center w-full py-3 pl-6 text-white transition duration-200 opacity-75 hover:opacity-100 nav-item account-link hover:bg-blue-500">
                    <i class="mr-3 fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 min-h-screen bg-gray-100 sm:ml-64">
        <div class="px-4 py-6 sm:px-6 lg:px-10 lg:py-10">
            @yield('content')
        </div>
    </main>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
        integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</body>
</html>
