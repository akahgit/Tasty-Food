@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="container w-full min-h-screen px-4 mx-auto">
        <h1 class="mb-8 text-3xl font-bold text-gray-800">Dashboard Admin</h1>

        @if ($unreadMessages > 0)
            <div class="p-4 mb-6 text-yellow-800 bg-yellow-100 border border-yellow-300 rounded-lg">
                🔔 Ada <strong>{{ $unreadMessages }}</strong> pesan baru!
                <a href="{{ route('admin.contact.index') }}" class="font-semibold underline">Lihat sekarang</a>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
            <div class="p-6 bg-white rounded-lg shadow">
                <h3 class="text-sm font-medium text-gray-500">Total Pesan</h3>
                <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $totalMessages }}</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow">
                <h3 class="text-sm font-medium text-gray-500">Belum Dibaca</h3>
                <p class="mt-2 text-3xl font-semibold text-red-600">{{ $unreadMessages }}</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow">
                <h3 class="text-sm font-medium text-gray-500">Total Berita</h3>
                <p class="mt-2 text-3xl font-semibold text-blue-600">{{ $totalNews }}</p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow">
                <h3 class="text-sm font-medium text-gray-500">Total Foto</h3>
                <p class="mt-2 text-3xl font-semibold text-green-600">{{ $totalGallery }}</p>
            </div>
        </div>

        <div class="mb-8 bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-800">Pesan Terbaru</h2>
            </div>
            <ul class="divide-y divide-gray-200">
                @forelse($latestMessages as $msg)
                    <li class="px-6 py-4 hover:bg-gray-50">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between">
                            <div class="flex-1">
                                <p class="font-medium text-gray-900">{{ $msg->name }}</p>
                                <p class="mt-1 text-sm text-gray-600">{{ Str::limit($msg->message, 100) }}</p>
                                <p class="mt-1 text-xs text-gray-500">{{ $msg->created_at->diffForHumans() }}</p>
                            </div>
                            <span
                                class="mt-2 sm:mt-0 sm:ml-4 px-2 py-1 text-xs rounded-full 
                                {{ $msg->read ? 'bg-gray-100 text-gray-800' : 'bg-red-100 text-red-800' }}">
                                {{ $msg->read ? 'Dibaca' : 'Baru' }}
                            </span>
                        </div>
                    </li>
                @empty
                    <li class="px-6 py-4 text-center text-gray-500">Tidak ada pesan.</li>
                @endforelse
            </ul>
        </div>

        <div>
            <h2 class="mb-4 text-lg font-medium text-gray-800">Aksi Cepat</h2>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">
                <a href="{{ route('admin.news.create') }}"
                    class="px-4 py-3 text-center text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">
                    + Tambah Berita
                </a>
                <a href="{{ route('admin.gallery.create') }}"
                    class="px-4 py-3 text-center text-white transition bg-green-600 rounded-lg hover:bg-green-700">
                    + Tambah Foto
                </a>
                <a href="{{ route('admin.contact.index') }}"
                    class="px-4 py-3 text-center text-white transition bg-yellow-600 rounded-lg hover:bg-yellow-700">
                    Lihat Pesan
                </a>
                <a href="{{ route('admin.about.edit') }}"
                    class="px-4 py-3 text-center text-white transition bg-purple-600 rounded-lg hover:bg-purple-700">
                    Edit Tentang
                </a>
            </div>
        </div>
    </div>
@endsection
