<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactMessageController extends Controller
{
    /**
     * Tampilkan daftar semua pesan kontak.
     */
    public function index()
    {
        $messages = ContactMessage::orderBy('read', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.contact.index', compact('messages'));
    }

    /**
     * Tampilkan detail pesan.
     */
    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);

        // Tandai sebagai sudah dibaca
        if (! $message->read) {
            $message->update(['read' => true]);
        }

        return view('admin.contact.show', compact('message'));
    }

    /**
     * Hapus pesan kontak.
     */
    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return redirect()->route('admin.contact.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}