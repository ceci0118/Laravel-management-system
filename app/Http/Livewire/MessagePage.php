<?php

namespace App\Http\Livewire;

use App\Mail\EmailDemo;
use Livewire\Component;
use App\Models\Applicant;
use App\Models\MailMessage;
use App\Models\MailTemplate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MessagePage extends Component
{
    public $to, $from, $cc, $subject, $content, $url, $btnText, $template_id;
    public $search = '';
    public $recipients = [];


    public function render()
    {
        $emails = array_map('trim', explode(',', $this->to));

        $this->search = end($emails);

        $applicants = Applicant::query()
            ->where('first', 'LIKE', '%' . $this->search . '%')
            ->orWhere('last', 'LIKE', '%' . $this->search . '%')
            ->get();

        return view('livewire.message-page', [
            'templates' => MailTemplate::all(),
            'applicants' => $applicants,
        ]);
    }


    public function addRecipient(Applicant $applicant)
    {
        if(count($this->recipients) == 0){
            $this->to = $applicant->full_name . ', '; 
        }else{
            $this->to = substr($this->to, 0, strrpos($this->to, ",", -1)). ', ';
            $this->to .= $applicant->full_name . ', ';
        }
         
        $this->search = '';

        array_push($this->recipients, $applicant);
    }

    public function create()
    {
        //send email to applicants or guardians
        //how to decide wether to send email to applicant or guardian (calculate by age?)??
        //change applicant status after sending email (if not a rowan's law email)??
        //***no validation for mail messages yet***
        //***no email tracking yet (opened/bounced) */

        // Create mail data by subject and content
        $mailData = [
            'title' => $this->subject,
            'body' => $this->content,
            'url' => $this->url,
            'btnText' => $this->btnText,
        ];

        if($this->cc != null){
            $cc_emails = array_map('trim', explode(',', $this->cc));
        }else {
            $cc_emails = [];
        }
        
        // Send email
        foreach ($this->recipients as $recipient) {

            // Get applicant name in email
            $mailData['name'] = $recipient['first'].' '. $recipient['last'];

            // Get unique url for rowan's 

            Mail::to($recipient['email'])
                ->cc($cc_emails ?: [])
                ->send(new EmailDemo($mailData));

            // Create new mailmessage in database
            MailMessage::create([
                'applicant_id' => $recipient['id'],
                'mail_template_id' => $this->template_id,
                'subject' => $this->subject,
                'content' => $this->content,
                'from' => 'do_not_reply@email.com',
                'to' => $recipient['email'],
                'cc' => $this->cc,
                'mail_status' => 1,
            ]);

            // Update applicant status???
        }
        // Show success message
        $this->dispatchBrowserEvent('notify', 'Email Messages Sent!');
        

        // Empty all input
        $this->to = $this->cc = $this->subject = $this->content = $this->search = $this->url = $this->btnText = '';
    }
}
