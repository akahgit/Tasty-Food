<?php

namespace App\Http\Controllers;

use App\Models\Map;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create()
    {
        $map = Map::first();
        return view('frontend.pages.kontak', compact('map'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'read' => false,
        ]);

        Mail::to('saefulamin574@gmail.com')->send(new ContactMail($validated));

        return back()->with('success', 'Terima kasih! Pesan Anda telah kami terima.');
    }
}
