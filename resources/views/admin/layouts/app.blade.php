<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Admin Dashboard</title>
    @vite('resources/css/app.css')
    <style>
    .font-family-karla { font-family: karla; }
    .bg-sidebar { 
        background: #ffffff;
        border-right: 1px solid #e5e7eb;
    }
    .active-nav-link { 
        background: #f3f4f6; 
        color: blue;
        border-right: 3px solid #6b7280;
    }
    .nav-item:hover { 
        background: #f9fafb; 
        color: blue;
    }
    .nav-item {
        color: blue;
        transition: all 0.2s ease;
    }
    .account-link:hover { 
        color: blue; 
    }
    .mobile-overlay {
        background: rgba(0, 0, 0, 0.5);
    }
    .sidebar-shadow {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    </style>

</head>

<body class="font-sans bg-gray-50">

    <!-- Mobile Overlay -->
    <div x-data="{ isOpen: false }" class="sm:hidden">
        <!-- Mobile Header -->
        <header class="fixed top-0 z-30 w-full px-4 py-4 bg-white border-b border-gray-200">
            <div class="flex items-center justify-between">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-semibold text-blue-800">Admin Dashboard</a>
                <button @click="isOpen = !isOpen" class="p-2 text-blue-600 hover:text-blue-800 focus:outline-none">
                    <i class="fas fa-bars text-lg"></i>
                </button>
            </div>
        </header>

        <!-- Mobile Backdrop -->
        <div x-show="isOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="isOpen = false"
             class="fixed inset-0 z-40 mobile-overlay"></div>

        <!-- Mobile Sidebar -->
        <aside x-show="isOpen" 
               x-transition:enter="transition ease-out duration-300"
               x-transition:enter-start="transform -translate-x-full"
               x-transition:enter-end="transform translate-x-0"
               x-transition:leave="transition ease-in duration-200"
               x-transition:leave-start="transform translate-x-0"
               x-transition:leave-end="transform -translate-x-full"
               class="fixed inset-y-0 left-0 z-50 w-64 bg-white sidebar-shadow">
            
            <div class="flex flex-col h-full">
                <!-- Mobile Header -->
                <div class="p-6 border-b border-gray-200">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="text-xl font-semibold text-blue-800 hover:text-blue-600">Admin Dashboard</a>
                </div>

                <!-- Mobile Nav -->
                <nav class="flex-1 px-4 py-6 overflow-y-auto">
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center py-3 px-4 mb-1 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'active-nav-link' : 'nav-item' }}">
                       <i class="mr-3 fas fa-tachometer-alt text-sm"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.about.edit') }}"
                       class="flex items-center py-3 px-4 mb-1 rounded-lg {{ request()->routeIs('admin.about.edit') ? 'active-nav-link' : 'nav-item' }}">
                       <i class="mr-3 fas fa-sticky-note text-sm"></i> Tentang
                    </a>
                    <a href="{{ route('admin.news.index') }}"
                       class="flex items-center py-3 px-4 mb-1 rounded-lg {{ request()->routeIs('admin.news.*') ? 'active-nav-link' : 'nav-item' }}">
                       <i class="mr-3 fas fa-align-left text-sm"></i> Berita
                    </a>
                    <a href="{{ route('admin.gallery.index') }}"
                       class="flex items-center py-3 px-4 mb-1 rounded-lg {{ request()->routeIs('admin.gallery.*') ? 'active-nav-link' : 'nav-item' }}">
                       <i class="mr-3 fas fa-table text-sm"></i> Gallery
                    </a>
                    <a href="{{ route('admin.contact.index') }}"
                       class="flex items-center py-3 px-4 mb-1 rounded-lg {{ request()->routeIs('admin.contact.*') ? 'active-nav-link' : 'nav-item' }}">
                       <i class="mr-3 fas fa-tablet-alt text-sm"></i> Kontak
                    </a>
                    <a href="{{ route('admin.map.edit') }}"
                       class="flex items-center py-3 px-4 mb-1 rounded-lg {{ request()->routeIs('admin.map.edit') ? 'active-nav-link' : 'nav-item' }}">
                       <i class="mr-3 fas fa-map-marked-alt text-sm"></i> Edit Maps
                    </a>
                    <a href="{{ route('frontend.index') }}" target="_blank"
                       class="flex items-center py-3 px-4 mb-1 rounded-lg nav-item">
                       <i class="mr-3 fas fa-external-link-alt text-sm"></i> Frontend
                    </a>
                </nav>

                <!-- Mobile Logout -->
                <div class="p-4 border-t border-gray-200">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full py-3 px-4 rounded-lg text-blue-400 hover:bg-blue-50 hover:text-blue-500">
                            <i class="mr-3 fas fa-sign-out-alt text-sm"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Mobile Main Content -->
        <main class="pt-16 min-h-screen bg-gray-50">
            <div class="px-4 py-6">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Desktop Layout -->
    <div class="hidden sm:flex">
        <!-- Desktop Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-10 w-64 bg-white sidebar-shadow">
            <div class="flex flex-col h-full">
                <!-- Header -->
                <div class="p-6 border-b border-gray-200">
                    <a href="{{ route('admin.dashboard') }}"
                        class="text-xl font-semibold text-blue-800 hover:text-blue-600">Admin Tasty Food</a>
                </div>

                <!-- Nav -->
                <nav class="flex-1 px-4 py-6 overflow-y-auto">
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center py-3 px-4 mb-1 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'active-nav-link' : 'nav-item' }}">
                       <i class="mr-3 fas fa-tachometer-alt text-sm"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.about.edit') }}"
                       class="flex items-center py-3 px-4 mb-1 rounded-lg {{ request()->routeIs('admin.about.edit') ? 'active-nav-link' : 'nav-item' }}">
                       <i class="mr-3 fas fa-sticky-note text-sm"></i> Tentang
                    </a>
                    <a href="{{ route('admin.news.index') }}"
                       class="flex items-center py-3 px-4 mb-1 rounded-lg {{ request()->routeIs('admin.news.*') ? 'active-nav-link' : 'nav-item' }}">
                       <i class="mr-3 fas fa-align-left text-sm"></i> Berita
                    </a>
                    <a href="{{ route('admin.gallery.index') }}"
                       class="flex items-center py-3 px-4 mb-1 rounded-lg {{ request()->routeIs('admin.gallery.*') ? 'active-nav-link' : 'nav-item' }}">
                       <i class="mr-3 fas fa-table text-sm"></i> Gallery
                    </a>
                    <a href="{{ route('admin.contact.index') }}"
                       class="flex items-center py-3 px-4 mb-1 rounded-lg {{ request()->routeIs('admin.contact.*') ? 'active-nav-link' : 'nav-item' }}">
                       <i class="mr-3 fas fa-tablet-alt text-sm"></i> Kontak
                    </a>
                    <a href="{{ route('admin.map.edit') }}"
                       class="flex items-center py-3 px-4 mb-1 rounded-lg {{ request()->routeIs('admin.map.edit') ? 'active-nav-link' : 'nav-item' }}">
                       <i class="mr-3 fas fa-map-marked-alt text-sm"></i> Edit Maps
                    </a>
                    <a href="{{ route('frontend.index') }}" target="_blank"
                       class="flex items-center py-3 px-4 mb-1 rounded-lg nav-item">
                       <i class="mr-3 fas fa-external-link-alt text-sm"></i> Frontend
                    </a>
                </nav>

                <!-- Logout -->
                <div class="p-4 border-t border-indigo-200">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full py-3 px-4 rounded-lg nav-item account-link">
                            <i class="mr-3 fas fa-sign-out-alt text-sm"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Desktop Main Content -->
        <main class="flex-1 ml-64 min-h-screen bg-gray-50">
            <div class="px-6 py-8 lg:px-10 lg:py-10">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
        integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</body>
</html>