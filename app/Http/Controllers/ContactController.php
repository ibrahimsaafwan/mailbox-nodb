<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact.form');
    }

    public function submitForm(ContactRequest $request)
    {
        $data = $request->validated();

        $paths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $fileName = time() . '_' . uniqid() . '.' . $file->extension();
                $path = $file->storeAs('uploads', $fileName, 'public');
                $paths[] = $path;
            }
        }

        $toEmail = 'vaibrahim24@gmail.com';

        Mail::to($toEmail)->send(new ContactMail($data, $paths));

        return redirect()->back()->with('Status', 'Form submitted successfully!');
    }
}
