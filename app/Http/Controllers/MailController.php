<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\EmailDemo;
use Symfony\Component\HttpFoundation\Response;


class MailController extends Controller {
    
    public function sendEmail() {
   
        $mailData = [
            'title' => 'Demo Email',
            'body' => 'This is content template for test email.'
        ];
        //send email to many emils addresses
        foreach (['sabarokni71@gmail.com', 'dries@example.com'] as $recipient) {
            Mail::to($recipient)->send(new EmailDemo($mailData));
        }
   
        echo "<h2>Sent Email Successfully!</h2>";
        dd("Email is Sent, please check your inbox.");

    }

}
