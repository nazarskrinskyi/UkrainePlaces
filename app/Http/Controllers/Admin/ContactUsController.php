<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactUsController extends Controller
{
    public function index(): View
    {
        $contactUsEntries = ContactUs::all();

        return view('admin.contact_us.index', compact('contactUsEntries'));
    }

    public function show($id): View
    {
        $contactUsEntry = ContactUs::findOrFail($id);

        return view('admin.contact_us.show', compact('contactUsEntry'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'content' => 'required',
        ]);

        ContactUs::create($validated);

        return redirect()->route('home')->with('success', 'Дякуємо за повідомлення!');
    }
}
