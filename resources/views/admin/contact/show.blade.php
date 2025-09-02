@extends('admin.layouts.app')

@section('title', 'Detail Pesan Kontak')

@section('content')
    <div class="container w-full h-screen px-10 py-10 mx-auto">
        <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl text-black">Detail Pesan</h1>
        <a href="{{ route('admin.contact.index') }}" 
           class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded hover:bg-gray-200">
            &larr; Kembali
        </a>
    </div>

    @if (session('success'))
        <div class="px-4 py-3 mb-6 text-green-700 bg-green-100 border border-green-200 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="p-6 bg-white rounded shadow">
        <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
            <div>
                <strong class="block text-sm font-semibold text-gray-500">Nama</strong>
                <p class="text-lg">{{ $message->name }}</p>
            </div>
            <div>
                <strong class="block text-sm font-semibold text-gray-500">Email</strong>
                <p class="text-lg text-blue-600">{{ $message->email }}</p>
            </div>
            <div>
                <strong class="block text-sm font-semibold text-gray-500">Subject</strong>
                <p>{{ $message->subject ?? '-' }}</p>
            </div>
            <div>
                <strong class="block text-sm font-semibold text-gray-500">Tanggal</strong>
                <p>{{ $message->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>

        <div class="mb-6">
            <strong class="block mb-2 text-sm font-semibold text-gray-500">Pesan</strong>
            <p class="p-4 text-gray-800 whitespace-pre-wrap border border-gray-200 rounded bg-gray-50">
                {{ $message->message }}
            </p>
        </div>

        <div class="flex items-center justify-between pt-6 mt-6 border-t">
            <span class="inline-flex items-center px-3 py-1 text-sm font-medium rounded 
                {{ $message->read ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $message->read ? 'Sudah Dibaca' : 'Belum Dibaca' }}
            </span>

            <form action="{{ route('admin.contact.destroy', $message->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 text-sm text-white bg-red-600 rounded hover:bg-red-700"
                        onclick="return confirm('Yakin ingin hapus pesan ini?')">
                    Hapus Pesan
                </button>
            </form>
        </div>
    </div>
    </div>
@endsection