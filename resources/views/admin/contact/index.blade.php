@extends('admin.layouts.app')

@section('title', 'Pesan Kontak Masuk')

@section('content')
    <div class="w-full min-h-screen px-6 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-semibold text-gray-900">Pesan Kontak Masuk</h1>
        </div>

        <!-- Notifikasi Sukses -->
        @if (session('success'))
            <div class="px-4 py-3 mb-6 text-green-700 bg-green-100 border-l-4 border-green-500 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Tampilan Kosong -->
        @if ($messages->isEmpty())
            <div class="col-span-full py-12 text-center">
                <div class="inline-flex flex-col items-center justify-center p-6 bg-gray-50 rounded-xl">
                    <i class="fas fa-envelope-open-text text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-700 mb-1">Belum ada pesan kontak</h3>
                    <p class="text-sm text-gray-500">Pesan dari pengunjung akan muncul di sini.</p>
                </div>
            </div>
        @else
            <!-- Daftar Pesan -->
            <div class="bg-white rounded-xl border border-gray-100 overflow-hidden shadow-sm">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Subjek</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Pesan</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($messages as $msg)
                                <tr class="{{ $msg->read ? 'bg-gray-50 hover:bg-gray-100' : 'bg-yellow-50 hover:bg-yellow-100 font-semibold' }} transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-700">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $msg->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $msg->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $msg->subject ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700 max-w-xs truncate" title="{{ $msg->message }}">
                                        {{ Str::limit($msg->message, 50) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $msg->read ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            <i class="fas {{ $msg->read ? 'fa-envelope-open' : 'fa-envelope' }} mr-1"></i>
                                            {{ $msg->read ? 'Sudah Dibaca' : 'Belum Dibaca' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                                        <a href="{{ route('admin.contact.show', $msg->id) }}" 
                                           class="inline-flex items-center px-3 py-1.5 text-indigo-600 bg-white border border-indigo-200 rounded-lg hover:bg-indigo-50 hover:text-indigo-700 transition-colors">
                                            <i class="fas fa-eye mr-1"></i> Lihat
                                        </a>
                                        <form action="{{ route('admin.contact.destroy', $msg->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin hapus pesan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-1.5 text-red-600 bg-white border border-red-200 rounded-lg hover:bg-red-50 hover:text-red-700 transition-colors">
                                                <i class="fas fa-trash mr-1"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection