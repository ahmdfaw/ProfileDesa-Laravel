<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.contacts.index', compact('contacts'));
    }

    public function markAsRead(Contact $contact): RedirectResponse
    {
        $contact->update(['is_read' => true]);

        return redirect()->route('admin.contacts.index')->with('success', 'Pesan berhasil ditandai sebagai sudah dibaca!');
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'Pesan berhasil dihapus!');
    }
}
