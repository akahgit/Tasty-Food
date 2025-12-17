@php
    // Helper untuk highlight teks
    if (!function_exists('highlightText')) {
        function highlightText($text, $search) {
            if (empty($search) || empty($text)) {
                return $text;
            }
            
            $searchTerms = explode(' ', $search);
            $highlightedText = $text;
            
            foreach ($searchTerms as $term) {
                if (strlen($term) > 2) {
                    $pattern = '/(' . preg_quote($term, '/') . ')/i';
                    $highlightedText = preg_replace($pattern, '<span class="bg-yellow-200 font-medium">$1</span>', $highlightedText);
                }
            }
            
            return $highlightedText;
        }
    }
@endphp

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
            <!-- Header tabel dengan statistik dan pencarian -->
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center space-x-4">
                        <h3 class="text-lg font-semibold text-gray-900">Daftar Berita</h3>
                        <span class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-sm font-medium">
                            {{ $news->total() }} artikel
                        </span>
                    </div>
                    
                    <!-- Form Pencarian -->
                    <form method="GET" action="{{ route('admin.news.index') }}" class="w-full sm:w-auto" id="searchForm">
                        <div class="flex flex-col sm:flex-row gap-3">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" 
                                       name="search" 
                                       id="searchInput"
                                       value="{{ request('search') }}"
                                       placeholder="Cari judul atau isi berita..." 
                                       class="pl-10 pr-10 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent w-full sm:w-64"
                                       autocomplete="off">
                                
                                <!-- Tombol Clear -->
                                @if(request()->has('search') && !empty(request('search')))
                                    <button type="button" 
                                            onclick="clearSearch()"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-times"></i>
                                    </button>
                                @endif
                            </div>
                            
                            <button type="submit"
                                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium flex items-center justify-center">
                                <i class="fas fa-search mr-2"></i>
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Info pencarian aktif -->
                @if(request()->has('search') && !empty(request('search')))
                    <div class="mt-3 flex flex-wrap items-center gap-2 text-sm text-gray-600">
                        <div class="flex items-center">
                            <i class="fas fa-filter mr-2"></i>
                            Hasil pencarian untuk: 
                            <span class="font-medium ml-1">"{{ request('search') }}"</span>
                        </div>
                        <a href="{{ route('admin.news.index') }}" 
                           class="text-indigo-600 hover:text-indigo-800 text-sm font-medium flex items-center">
                            <i class="fas fa-times mr-1"></i> Hapus filter
                        </a>
                    </div>
                @endif
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
                                        {{ ($news->currentPage() - 1) * $news->perPage() + $loop->iteration }}
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
                                                @if(request()->has('search') && !empty(request('search')))
                                                    {!! highlightText($item->title, request('search')) !!}
                                                @else
                                                    {{ Str::limit($item->title, 40) }}
                                                @endif
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                @php
                                                    // Generate excerpt dari content (50 karakter pertama)
                                                    $excerptText = Str::limit(strip_tags($item->content), 50);
                                                @endphp
                                                
                                                @if(request()->has('search') && !empty(request('search')))
                                                    {!! highlightText($excerptText, request('search')) !!}
                                                @else
                                                    {{ $excerptText }}
                                                @endif
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
                                            class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors text-sm font-medium"
                                            title="Edit berita">
                                            <i class="fas fa-edit mr-1"></i>
                                            Edit
                                        </a>
                                        <!-- PERBAIKAN: Gunakan route yang benar -->
                                        @php
                                            // Opsi 1: Jika menggunakan route frontend.berita.detail
                                            $viewLink = route('frontend.berita.detail', $item->id);
                                            
                                            // Opsi 2: Jika berita menggunakan slug
                                            // $viewLink = $item->slug ? route('frontend.berita.detail', $item->slug) : route('frontend.berita.detail', $item->id);
                                        @endphp
                                        <a href="{{ $viewLink }}" target="_blank"
                                            class="inline-flex items-center px-3 py-1.5 bg-green-50 text-green-700 rounded-lg hover:bg-green-100 transition-colors text-sm font-medium"
                                            title="Lihat di frontend">
                                            <i class="fas fa-external-link-alt mr-1"></i>
                                            Lihat
                                        </a>
                                        <button onclick="confirmDelete({{ $item->id }})"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors text-sm font-medium"
                                            title="Hapus berita">
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
                                        @if(request()->has('search') && !empty(request('search')))
                                            <i class="fas fa-search text-gray-400 text-2xl"></i>
                                        @else
                                            <i class="fas fa-newspaper text-gray-400 text-2xl"></i>
                                        @endif
                                    </div>
                                    @if(request()->has('search') && !empty(request('search')))
                                        <h3 class="text-sm font-medium text-gray-900 mb-1">Tidak ditemukan</h3>
                                        <p class="text-sm text-gray-500 mb-4">Tidak ada berita yang cocok dengan pencarian "{{ request('search') }}"</p>
                                        <a href="{{ route('admin.news.index') }}"
                                            class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors font-medium">
                                            <i class="fas fa-times mr-2"></i>
                                            Tampilkan Semua Berita
                                        </a>
                                    @else
                                        <h3 class="text-sm font-medium text-gray-900 mb-1">Belum ada berita</h3>
                                        <p class="text-sm text-gray-500 mb-4">Mulai dengan membuat artikel pertama Anda</p>
                                        <a href="{{ route('admin.news.create') }}"
                                            class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                                            <i class="fas fa-plus mr-2"></i>
                                            Tambah Berita Pertama
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Info pagination -->
            @if($news->total() > 0)
                <div class="px-6 py-3 border-t border-gray-100 bg-gray-50 text-sm text-gray-600">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            Menampilkan {{ $news->firstItem() }} - {{ $news->lastItem() }} dari {{ $news->total() }} berita
                        </div>
                        <div class="mt-2 sm:mt-0">
                            Halaman {{ $news->currentPage() }} dari {{ $news->lastPage() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($news->hasPages())
            <div class="mt-6">
                {{ $news->withQueryString()->links() }}
            </div>
        @endif
    </div>

    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus berita ini?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
        
        function clearSearch() {
            document.getElementById('searchInput').value = '';
            document.getElementById('searchForm').submit();
        }
        
        // Auto submit setelah 3 karakter atau lebih
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            let searchTimeout;
            
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    if (this.value.length >= 3 || this.value.length === 0) {
                        this.form.submit();
                    }
                }, 800);
            });
            
            // Enter untuk submit
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    this.form.submit();
                }
            });
        });
    </script>
@endsection