@extends('admin.layouts.app')

@section('content')
    <div class="w-full min-h-screen">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-semibold text-gray-900">Edit Tentang Kami</h1>
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

        <!-- Form -->
        <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Konten Teks -->
                <div class="space-y-6">
                    <div class="bg-white rounded-xl border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Umum</h3>

                        <div class="space-y-6">
                            <!-- Deskripsi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-align-left text-gray-400 mr-2"></i>
                                    Deskripsi
                                </label>
                                <textarea name="description" rows="4" placeholder="Masukkan deskripsi tentang organisasi..."
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors resize-none">{{ old('description', $about->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Visi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-eye text-gray-400 mr-2"></i>
                                    Visi
                                </label>
                                <textarea name="vision" rows="4" placeholder="Masukkan visi organisasi..."
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors resize-none">{{ old('vision', $about->vision) }}</textarea>
                                @error('vision')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Misi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-target text-gray-400 mr-2"></i>
                                    Misi
                                </label>
                                <textarea name="mission" rows="4" placeholder="Masukkan misi organisasi..."
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-colors resize-none">{{ old('mission', $about->mission) }}</textarea>
                                @error('mission')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upload Gambar -->
                <div class="space-y-6">
                    <!-- Gambar Visi -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-image text-gray-400 mr-2"></i>
                            Gambar Visi
                        </h3>

                        <!-- Preview gambar saat ini -->
                        @if ($about->image_1)
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
                                <div class="relative group">
                                    <img src="{{ asset('storage/about/' . $about->image_1) }}" alt="Gambar Visi"
                                        class="w-full h-48 object-cover rounded-lg border border-gray-200">
                                    <div
                                        class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all rounded-lg">
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Upload baru -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $about->image_1 ? 'Ganti Gambar' : 'Upload Gambar' }}
                            </label>
                            <div
                                class="border-2 border-dashed border-gray-200 rounded-lg p-4 hover:border-indigo-300 transition-colors">
                                <input type="file" name="image_1" accept="image/*"
                                    class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100">
                            </div>
                            <p class="mt-2 text-xs text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Maksimal 2MB • Format: JPG, PNG, WebP
                            </p>
                            @error('image_1')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Gambar Misi -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            <i class="fas fa-image text-gray-400 mr-2"></i>
                            Gambar Misi
                        </h3>

                        <!-- Preview gambar saat ini -->
                        @if ($about->image_2)
                            <div class="mb-4">
                                <p class="text-sm text-gray-600 mb-2">Gambar saat ini:</p>
                                <div class="relative group">
                                    <img src="{{ asset('storage/about/' . $about->image_2) }}" alt="Gambar Misi"
                                        class="w-full h-48 object-cover rounded-lg border border-gray-200">
                                    <div
                                        class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all rounded-lg">
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Upload baru -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $about->image_2 ? 'Ganti Gambar' : 'Upload Gambar' }}
                            </label>
                            <div
                                class="border-2 border-dashed border-gray-200 rounded-lg p-4 hover:border-indigo-300 transition-colors">
                                <input type="file" name="image_2" accept="image/*"
                                    class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100">
                            </div>
                            <p class="mt-2 text-xs text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Maksimal 2MB • Format: JPG, PNG, WebP
                            </p>
                            @error('image_2')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-8 flex items-center justify-between pt-6 border-t border-gray-200">
                <div class="text-sm text-gray-500">
                    <i class="fas fa-save mr-1"></i>
                    Pastikan semua data sudah benar sebelum menyimpan
                </div>
                <button type="submit"
                    class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection
