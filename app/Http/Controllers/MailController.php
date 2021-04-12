<?php

namespace App\Http\Controllers;
use App\Mail\EmailDemo;

use App\Models\MailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;


class MailController extends Controller {

    public function index()
    {
        $templates = MailTemplate::all();
        
        return view('message', compact('templates'));
    }

    public function create(request $request)
    {
        $recipients = array_map('trim', explode(',', $request->to));

        $mailData = [
            'title' => $request->subject,
            'body' => $request->content
        ];

        // foreach ($recipients as $recipient) {
        //     Mail::to($recipient)->send(new EmailDemo($mailData));
        // }

        dd($recipients);
    }
    
    public function sendEmail() {
   
        $mailData = [
            'title' => 'Demo Email',
            'body' => 'This is content template for test email.'
        ];
        //send email to many emils addresses
        foreach (['cecilaw0118@gmail.com'] as $recipient) {
            Mail::to($recipient)->send(new EmailDemo($mailData));
        }
   
        echo "<h2>Sent Email Successfully!</h2>";
        dd("Email is Sent, please check your inbox.");

    }

}
