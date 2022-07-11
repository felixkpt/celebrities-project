<?php 
    namespace App\Notifications;
    
    use App\Mail\ContactMarkDown;
    use Illuminate\Notifications\Notification;
    use App\Http\Requests\ContactFormRequest;
    
    class ContactFormMessage extends Notification
    {

        public function __construct(contactforMrequest $message)
        {
            $this->message = $message;
        }

        public function via()
        {
            return ['mail'];
        }
    
        public function toMail()
        {

            return (new ContactMarkDown($this->message));
        }
    }