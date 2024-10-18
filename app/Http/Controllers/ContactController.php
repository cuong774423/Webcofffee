<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::all();
        return view('admin.contact.contact', compact('contacts'));
    }
    public function view()
    {
        return view('pages.contact');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|email',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        Contact::create($validatedData);

        return redirect()->back()->with('success', 'Liên hệ của bạn đã được gửi thành công.');
    }
}
