<?php 
namespace App\Mail;

use Illuminate\Mail\Mailable;

class ContactMarkDown extends Mailable
{
  public function __construct(private $message)
  {
  }

  public function build()
  {

         //  ->subject(config('recipient.name') . ", you have a new message!")
    //  ->greeting(" Hlow")
    //  ->salutation(" saluting you")
    //  ->from($this->message->email, $this->message->name)
    //  ->line($this->message->message);
    // dd($this->message->title);
    return $this
            ->subject('Email from '.\Site::name())
            ->to('felixkpt@gmail.com')
            ->from($this->message->email)
            ->markdown('emails/contacts', 
                ['message' => $this->message, 'toname' => 'Admin']);
  }
}