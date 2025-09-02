@extends('admin.layouts.app')

@section('title', 'Pesan Kontak Masuk')

@section('content')
    <div class="container w-full min-h-screen px-4 py-6 mx-auto sm:px-6 lg:px-10 lg:py-10">
        <h1 class="pt-16 pb-6 text-3xl text-black sm:pt-0">Pesan Kontak</h1>

        @if (session('success'))
            <div class="px-4 py-3 mb-6 text-green-700 bg-green-100 border border-green-200 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($messages->isEmpty())
            <div class="p-6 text-gray-500 bg-white rounded shadow">
                Belum ada pesan kontak.
            </div>
        @else
            <div class="overflow-x-auto bg-white rounded shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">No</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">Nama</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">Subject</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">Pesan</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($messages as $msg)
                            <tr class="{{ $msg->read ? 'bg-gray-50' : 'bg-yellow-50 font-semibold' }}">
                                <td class="px-2 py-2 text-center border">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm">{{ $msg->name }}</td>
                                <td class="px-6 py-4 text-sm">{{ $msg->email }}</td>
                                <td class="px-6 py-4 text-sm">{{ $msg->subject ?? '-' }}</td>
                                <td class="max-w-xs px-6 py-4 text-sm truncate" title="{{ $msg->message }}">
                                    {{ Str::limit($msg->message, 50) }}
                                </td>
                                <td class="block px-6 py-4 text-sm">
                                    <span class="px-2 py-1 text-xs rounded 
                                        {{ $msg->read ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $msg->read ? 'Sudah Dibaca' : 'Belum Dibaca' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium blcok">
                                    <a href="{{ route('admin.contact.show', $msg->id) }}" 
                                       class="mr-3 text-blue-600 hover:text-blue-900">Lihat</a>
                                    <form action="{{ route('admin.contact.destroy', $msg->id) }}" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('Yakin ingin hapus pesan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection