<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Show the application contact page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageData = [
            'pageTitle' => trans('blog.contact.pageTitle'),
            'pageDesc'  => trans('blog.contact.pageDesc'),
            'title'     => trans('blog.contact.title'),
            'subtitle'  => trans('blog.contact.subtitle'),
            'image'     => config('blog.contact_page_image'),
        ];

        return view('blog.pages.contact', $pageData);
    }

    /**
     * Send Contact Email Function via Mail.
     *
     * @return \Illuminate\Http\Response
     */
    public function contactSend(ContactRequest $request)
    {
        $validatedData = $request->validated();

        Mail::to(config('blog.contact_email'))->send(new ContactMail($validatedData));

        return back()->withSuccess(trans('forms.contact.messages.sent'));
    }
}
