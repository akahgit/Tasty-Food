@extends('admin.layouts.app')

@section('content')
    <div class="w-full min-h-screen">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">Manajemen Berita</h1>
                    <p class="text-gray-500 mt-1">Kelola semua artikel dan berita organisasi</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <a href="{{ route('admin.news.create') }}"
                        class="inline-flex items-center px-4 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Berita
                    </a>
                </div>
            </div>
        </div>

        <!-- Alert sukses -->
        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 mb-8">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-emerald-600"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Tabel Berita -->
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
            <!-- Header tabel dengan statistik -->
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Berita</h3>
                        <span class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-sm font-medium">
                            {{ count($news) }} artikel
                        </span>
                    </div>
                </div>
            </div>

            <!-- Tabel -->
            <div class="overflow-x-auto">
                <table class="w-full min-w-[768px]">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Berita
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Penulis
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($news as $item)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <!-- Nomor -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-500">
                                        {{ $loop->iteration }}
                                    </div>
                                </td>

                                <!-- Judul Berita -->
                                <td class="px-6 py-4">
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-newspaper text-indigo-600"></i>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate max-w-[200px]" 
                                               title="{{ $item->title }}">
                                                {{ Str::limit($item->title, 40) }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ Str::limit(strip_tags($item->excerpt ?? ''), 50) }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Penulis -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-gradient-to-br from-gray-400 to-gray-600 rounded-full flex items-center justify-center">
                                            <span class="text-white font-medium text-xs">
                                                {{ substr($item->author->name, 0, 1) }}
                                            </span>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $item->author->name }}</p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($item->is_published)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                            <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full mr-1.5"></span>
                                            Published
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                            <span class="w-1.5 h-1.5 bg-amber-400 rounded-full mr-1.5"></span>
                                            Draft
                                        </span>
                                    @endif
                                </td>

                                <!-- Tanggal -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $item->created_at->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $item->created_at->format('H:i') }}</div>
                                </td>

                                <!-- Aksi -->
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.news.edit', $item->id) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors text-sm font-medium">
                                            <i class="fas fa-edit mr-1"></i>
                                            Edit
                                        </a>
                                        <button onclick="confirmDelete({{ $item->id }})"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors text-sm font-medium">
                                            <i class="fas fa-trash mr-1"></i>
                                            Hapus
                                        </button>
                                    </div>

                                    <form id="delete-form-{{ $item->id }}"
                                        action="{{ route('admin.news.destroy', $item->id) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <!-- Empty state -->
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-newspaper text-gray-400 text-2xl"></i>
                                    </div>
                                    <h3 class="text-sm font-medium text-gray-900 mb-1">Belum ada berita</h3>
                                    <p class="text-sm text-gray-500 mb-4">Mulai dengan membuat artikel pertama Anda</p>
                                    <a href="{{ route('admin.news.create') }}"
                                        class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                                        <i class="fas fa-plus mr-2"></i>
                                        Tambah Berita
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination jika ada -->
        @if(method_exists($news, 'links'))
            <div class="mt-6">
                {{ $news->links() }}
            </div>
        @endif
    </div>
@endsection