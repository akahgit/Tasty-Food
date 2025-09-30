@extends('admin.layouts.app')

@section('title', 'Edit Berita')

@section('content')
    <div class="w-full min-h-screen">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-2">
                <a href="{{ route('admin.news.index') }}" 
                   class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h1 class="text-2xl font-semibold text-gray-900">Edit Berita</h1>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Konten Utama -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Judul Berita -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-heading text-gray-400 mr-2"></i>
                            Informasi Berita
                        </h3>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Judul Berita
                            </label>
                            <input type="text" 
                                   name="title" 
                                   value="{{ old('title', $news->title) }}"
                                   placeholder="Masukkan judul berita yang menarik..."
                                   class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors @error('title') border-red-300 @enderror" 
                                   required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Konten Berita -->
                    <div class="bg-white rounded-xl border border-gray-100 p-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-align-left text-gray-400 mr-2"></i>
                            Isi Berita
                        </h3>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Konten Artikel
                            </label>
                            <textarea name="content" 
                                      rows="23"
                                      placeholder="Tulis isi berita lengkap di sini..."
                                      class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors resize-none @error('content') border-red-300 @enderror" 
                                      required>{{ old('content', $news->content) }}</textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-xs text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Gunakan bahasa yang jelas dan mudah dipahami
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Upload Gambar -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-image text-gray-400 mr-2"></i>
                            Gambar Berita
                        </h3>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Gambar Saat Ini
                            </label>
                            @if ($news->image)
                                <div class="mb-4">
                                    <img src="{{ Storage::url('news/' . $news->image) }}" 
                                         alt="Gambar berita"
                                         class="object-cover w-full h-40 rounded-lg shadow-sm">
                                </div>
                            @else
                                <p class="text-sm text-gray-500 italic mb-4">Belum ada gambar</p>
                            @endif

                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Ganti Gambar (Opsional)
                            </label>
                            <div class="border-2 border-dashed border-gray-200 rounded-lg p-6 text-center hover:border-indigo-300 transition-colors">
                                <div class="mb-3">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400"></i>
                                </div>
                                <input type="file" 
                                       name="image" 
                                       accept="image/*"
                                       class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-600">
                                <p class="mt-2 text-xs text-gray-500">
                                    Drag & drop atau klik untuk upload
                                </p>
                            </div>
                            <p class="mt-2 text-xs text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Maksimal 2MB • Format: JPG, PNG, WebP
                            </p>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Pengaturan Publikasi -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-cog text-gray-400 mr-2"></i>
                            Pengaturan
                        </h3>
                        
                        <div class="space-y-4">
                            <!-- Status Publikasi -->
                            <div class="flex items-start space-x-3 p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center h-5">
                                    <input type="hidden" name="is_published" value="0">
                                    <input type="checkbox" 
                                           name="is_published" 
                                           value="1" 
                                           id="is_published"
                                           {{ old('is_published', $news->is_published) ? 'checked' : '' }}
                                           class="w-4 h-4 text-indigo-600 bg-white border-gray-300 rounded focus:ring-indigo-500 focus:ring-2">
                                </div>
                                <div class="flex-1">
                                    <label for="is_published" class="text-sm font-medium text-gray-900 cursor-pointer">
                                        Publikasikan Berita
                                    </label>
                                    <p class="text-xs text-gray-500 mt-1">
                                        Centang untuk langsung mempublikasikan berita
                                    </p>
                                </div>
                            </div>

                            <!-- Info tambahan -->
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <div class="flex items-start space-x-2">
                                    <i class="fas fa-lightbulb text-blue-600 mt-0.5"></i>
                                    <div>
                                        <p class="text-sm font-medium text-blue-800">Tips:</p>
                                        <p class="text-xs text-blue-700 mt-1">
                                            Simpan sebagai draft terlebih dahulu untuk review sebelum dipublikasi
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Primary Button - Simpan -->
                            <button type="submit" 
                                    class="flex items-center justify-center w-full px-6 py-3 bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200 text-white font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                                <i class="fas fa-save mr-2"></i>
                                Perbarui Berita
                            </button>
                            
                            <!-- Secondary Button - Kembali -->
                            <a href="{{ route('admin.news.index') }}" 
                               class="flex items-center justify-center w-full px-6 py-3 bg-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-200 text-gray-700 font-medium border border-gray-300 rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection