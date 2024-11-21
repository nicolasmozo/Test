<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageInformation extends Mailable
{
    use Queueable, SerializesModels;


    public $template;
    public $subject;
    public $user_email;
    public function __construct($template,$subject,$user_email)
    {
        $this->template=$template;
        $this->subject=$subject;
        $this->user_email=$user_email;
    }


    public function build()
    {
        $template = $this->template;
        $subject = $this->subject;
        $user_email = $this->user_email;
        return $this->from($user_email)->subject($subject)->view('contact_message', compact('template'));
    }
}
