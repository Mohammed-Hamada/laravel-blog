<?php

namespace App\Http\Controllers;

use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    public function __invoke(Newsletter $newsletter)
    {
        dd($newsletter);
        request()->validate([
            'email' => 'required|email'
        ]);

        try {

            $newsletter->subscribe(request('email'));

        } catch (\Exception $e) {

            throw ValidationException::withMessages([
                'email' => 'This email cannot be added to our newsletter list'
            ]);

        }

        return redirect('/')
            ->with(
                'success',
                'This email was subscribed to our newsletter'
            );
    }
}