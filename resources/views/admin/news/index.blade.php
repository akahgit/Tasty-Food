@extends('admin.layouts.app')

@section('content')
    <div class="container px-4 py-6 mx-auto sm:px-6 lg:px-10 lg:py-10">
        <h1 class="pt-16 pb-6 text-3xl font-semibold text-black sm:pt-0">Manajemen berita</h1>

        @if (session('success'))
            <div class="px-4 py-3 mb-6 text-green-600 bg-green-100 border border-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.news.create') }}"
                class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300">
                + Tambah Berita
            </a>
        </div>

        <!-- Responsif: Scroll Horizontal -->
        <div class="overflow-x-auto">
            <table class="w-full border-collapse rounded-lg shadow-md min-w-[768px]">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-600 to-indigo-600">
                        <th class="px-4 py-3 text-xs font-semibold tracking-wider text-left text-white uppercase sm:text-sm">
                            No
                        </th>
                        <th
                            class="px-4 py-3 text-xs font-semibold tracking-wider text-left text-white uppercase sm:text-sm">
                            Judul
                        </th>
                        <th
                            class="px-4 py-3 text-xs font-semibold tracking-wider text-left text-white uppercase sm:text-sm">
                            Penulis
                        </th>
                        <th
                            class="px-4 py-3 text-xs font-semibold tracking-wider text-center text-white uppercase sm:text-sm">
                            Status
                        </th>
                        <th
                            class="px-4 py-3 text-xs font-semibold tracking-wider text-left text-white uppercase sm:text-sm">
                            Tanggal
                        </th>
                        <th
                            class="px-4 py-3 text-xs font-semibold tracking-wider text-center text-white uppercase sm:text-sm">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach ($news as $item)
                        <tr class="transition hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-4 py-3 text-sm truncate max-w-[150px]" title="{{ $item->title }}">
                                {{ Str::limit($item->title, 25) }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $item->author->name }}
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                <span
                                    class="inline-block px-3 py-1 text-xs font-medium text-white rounded-full 
                            {{ $item->is_published ? 'bg-green-500' : 'bg-yellow-500 text-gray-800' }}">
                                    {{ $item->is_published ? 'Public' : 'Draft' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600">
                                {{ $item->created_at->format('d M Y') }}
                            </td>
                            <td class="px-4 py-3 text-sm text-center space-x-3">
                                <a href="{{ route('admin.news.edit', $item->id) }}"
                                    class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
                                <a href="#"
                                    onclick="if(confirm('Yakin hapus berita?')) document.getElementById('delete-form-{{ $item->id }}').submit()"
                                    class="text-red-600 hover:text-red-800 font-medium">Hapus</a>

                                <form id="delete-form-{{ $item->id }}"
                                    action="{{ route('admin.news.destroy', $item->id) }}" method="POST" class="hidden">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
