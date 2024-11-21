<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $subscriber;
    public $template;
    public $subject;
    public $verification_link;
    public function __construct($subscriber,$template,$subject, $verification_link)
    {
        $this->subscriber=$subscriber;
        $this->template=$template;
        $this->subject=$subject;
        $this->verification_link=$verification_link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subscriber=$this->subscriber;
        $template=$this->template;
        $verification_link=$this->verification_link;
        return $this->subject($this->subject)->view('subscription_verification_email',compact('subscriber','template','verification_link'));
    }
}
