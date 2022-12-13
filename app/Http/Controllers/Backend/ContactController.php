<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        return view('backend.pages.contact.index');
    }

    public function show(Contact $contact)
    {
        $contact->update(['is_read' => 1, 'read_at' => Carbon::now()]);

        $contact->refresh();

        return view('backend.pages.contact.show', ['contact' => $contact]);
    }
}
