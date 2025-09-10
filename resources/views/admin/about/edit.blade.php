@extends('admin.layouts.app')

@section('content')
    <div class="container w-full min-h-screen px-4 mx-auto sm:px-6 lg:px-10">
        <h1 class="mb-6 text-xl font-bold sm:text-2xl mt-20 lg:mt-0">Edit Tentang Kami</h1>

        @if (session('success'))
            <div class="px-4 py-3 mb-6 text-green-400 bg-green-100 border border-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-8">
                <!-- Kolom Kiri: Deskripsi -->
                <div class="space-y-4 sm:space-y-6">
                    <div>
                        <label class="block mb-2 text-sm font-semibold sm:text-base">Deskripsi</label>
                        <textarea name="description" 
                                  rows="3" 
                                  class="w-full p-2 text-sm border rounded-md sm:p-3 sm:text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $about->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold sm:text-base">Visi</label>
                        <textarea name="vision" 
                                  rows="3" 
                                  class="w-full p-2 text-sm border rounded-md sm:p-3 sm:text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('vision', $about->vision) }}</textarea>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold sm:text-base">Misi</label>
                        <textarea name="mission" 
                                  rows="3" 
                                  class="w-full p-2 text-sm border rounded-md sm:p-3 sm:text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('mission', $about->mission) }}</textarea>
                    </div>
                </div>

                <!-- Kolom Kanan: Gambar -->
                <div class="space-y-4 sm:space-y-6">
                    <div>
                        <label class="block mb-2 text-sm font-semibold sm:text-base">Gambar 1 (Visi)</label>
                        @if ($about->image_1)
                            <div class="mb-2">
                                <img src="{{ asset('storage/about/' . $about->image_1) }}" 
                                     alt="Gambar 1"
                                     class="object-cover w-24 h-24 rounded sm:w-32 sm:h-32 lg:w-40 lg:h-40">
                            </div>
                        @endif
                        <input type="file" 
                               name="image_1" 
                               class="w-full p-2 text-sm border rounded-md sm:text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <p class="mt-1 text-xs text-gray-500 sm:text-sm">Max 2MB, format: jpg, png, webp</p>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-semibold sm:text-base">Gambar 2 (Misi)</label>
                        @if ($about->image_2)
                            <div class="mb-2">
                                <img src="{{ asset('storage/about/' . $about->image_2) }}" 
                                     alt="Gambar 2"
                                     class="object-cover w-24 h-24 rounded sm:w-32 sm:h-32 lg:w-40 lg:h-40">
                            </div>
                        @endif
                        <input type="file" 
                               name="image_2" 
                               class="w-full p-2 text-sm border rounded-md sm:text-base focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <p class="mt-1 text-xs text-gray-500 sm:text-sm">Max 2MB, format: jpg, png, webp</p>
                    </div>
                </div>
            </div>

            <div class="mt-6 sm:mt-8">
                <button type="submit" 
                        class="w-full px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:w-auto sm:text-base">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection