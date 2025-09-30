@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="w-full min-h-screen">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-semibold text-gray-900 mb-2">Dashboard</h1>
        </div>

        <!-- Notifikasi pesan baru -->
        @if ($unreadMessages > 0)
            <div class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-xl p-4 mb-8">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-bell text-amber-600"></i>
                        </div>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-amber-800">
                            Ada <span class="font-semibold">{{ $unreadMessages }}</span> pesan baru menunggu!
                        </p>
                    </div>
                    <div class="ml-4">
                        <a href="{{ route('admin.contact.index') }}" 
                           class="bg-amber-100 hover:bg-amber-200 text-amber-800 px-3 py-1.5 rounded-lg text-sm font-medium transition-colors">
                            Lihat Pesan
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Pesan -->
            <div class="bg-white rounded-xl border border-gray-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Pesan</p>
                        <p class="text-2xl font-semibold text-gray-900 mt-1">{{ $totalMessages }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                        <i class="fas fa-comments text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Belum Dibaca -->
            <div class="bg-white rounded-xl border border-gray-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Belum Dibaca</p>
                        <p class="text-2xl font-semibold text-red-600 mt-1">{{ $unreadMessages }}</p>
                    </div>
                    <div class="w-12 h-12 bg-red-50 rounded-lg flex items-center justify-center">
                        <i class="fas fa-envelope text-red-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Berita -->
            <div class="bg-white rounded-xl border border-gray-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Berita</p>
                        <p class="text-2xl font-semibold text-indigo-600 mt-1">{{ $totalNews }}</p>
                    </div>
                    <div class="w-12 h-12 bg-indigo-50 rounded-lg flex items-center justify-center">
                        <i class="fas fa-newspaper text-indigo-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Foto -->
            <div class="bg-white rounded-xl border border-gray-100 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Foto</p>
                        <p class="text-2xl font-semibold text-emerald-600 mt-1">{{ $totalGallery }}</p>
                    </div>
                    <div class="w-12 h-12 bg-emerald-50 rounded-lg flex items-center justify-center">
                        <i class="fas fa-images text-emerald-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pesan Terbaru -->
        <div class="bg-white rounded-xl border border-gray-100 mb-8 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">Pesan Terbaru</h2>
                    <a href="{{ route('admin.contact.index') }}" 
                       class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">
                        Lihat Semua
                    </a>
                </div>
            </div>
            
            <div class="divide-y divide-gray-100">
                @forelse($latestMessages as $msg)
                    <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-400 to-indigo-600 rounded-full flex items-center justify-center">
                                        <span class="text-white font-medium text-sm">{{ substr($msg->name, 0, 1) }}</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-medium text-gray-900 truncate">{{ $msg->name }}</p>
                                        <p class="text-sm text-gray-600 truncate">{{ Str::limit($msg->message, 80) }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ $msg->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                @if($msg->read)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Dibaca
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <span class="w-1.5 h-1.5 bg-red-400 rounded-full mr-1.5"></span>
                                        Baru
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-12 text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-inbox text-gray-400 text-2xl"></i>
                        </div>
                        <p class="text-gray-500 text-sm">Belum ada pesan masuk</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Menu Cepat -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Menu Cepat</h2>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('admin.news.create') }}" 
                   class="group bg-white hover:bg-indigo-50 border border-gray-200 hover:border-indigo-200 rounded-xl p-4 transition-all duration-200">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-12 h-12 bg-indigo-100 group-hover:bg-indigo-200 rounded-lg flex items-center justify-center mb-3 transition-colors">
                            <i class="fas fa-plus text-indigo-600"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-900 group-hover:text-indigo-600 transition-colors">Tambah Berita</span>
                    </div>
                </a>

                <a href="{{ route('admin.gallery.create') }}" 
                   class="group bg-white hover:bg-emerald-50 border border-gray-200 hover:border-emerald-200 rounded-xl p-4 transition-all duration-200">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-12 h-12 bg-emerald-100 group-hover:bg-emerald-200 rounded-lg flex items-center justify-center mb-3 transition-colors">
                            <i class="fas fa-plus text-emerald-600"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-900 group-hover:text-emerald-600 transition-colors">Tambah Foto</span>
                    </div>
                </a>

                <a href="{{ route('admin.contact.index') }}" 
                   class="group bg-white hover:bg-amber-50 border border-gray-200 hover:border-amber-200 rounded-xl p-4 transition-all duration-200">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-12 h-12 bg-amber-100 group-hover:bg-amber-200 rounded-lg flex items-center justify-center mb-3 transition-colors">
                            <i class="fas fa-envelope text-amber-600"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-900 group-hover:text-amber-600 transition-colors">Lihat Pesan</span>
                    </div>
                </a>

                <a href="{{ route('admin.about.edit') }}" 
                   class="group bg-white hover:bg-purple-50 border border-gray-200 hover:border-purple-200 rounded-xl p-4 transition-all duration-200">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-12 h-12 bg-purple-100 group-hover:bg-purple-200 rounded-lg flex items-center justify-center mb-3 transition-colors">
                            <i class="fas fa-edit text-purple-600"></i>
                        </div>
                        <span class="text-sm font-medium text-gray-900 group-hover:text-purple-600 transition-colors">Edit Tentang</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection